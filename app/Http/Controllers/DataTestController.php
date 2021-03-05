<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Establishment;

class DataTestController extends Controller
{
    private static function concatAddress($item) {
        $address = "";
        if(strlen($item['AddressLine1']) > 0) {
            $address .= $item['AddressLine1'] . ",\n";
        }
        if(strlen($item['AddressLine2']) > 0) {
            $address .= $item['AddressLine2'] . ",\n";
        }
        if(strlen($item['AddressLine3']) > 0) {
            $address .= $item['AddressLine3'] . ",\n";
        }
        if(strlen($item['AddressLine4']) > 0) {
            $address .= $item['AddressLine4'];
        }
        return $address;
    }

    private static function consumeToDatabase($business_type_id, $start_time)
    {
        $start_time = microtime(true);

        $total_pages = Http::withHeaders(['x-api-version' => '2'])->get(
            "http://api.ratings.food.gov.uk/Establishments?businessTypeId={$business_type_id}&maxDistanceLimit=20&sortOptionKey=Distance&pageNumber=0&pageSize=200&localAuthorityId=180"
        )->json()['meta']['totalPages'];

        $end_time = (microtime(true) - $start_time);
        echo "First API read took: " . $end_time . "seconds\n";

        for($page_number = 1; $page_number <= $total_pages; $page_number++) {
            //echo "Processing page " . ($page_number) . " of " . $total_pages . ". Elapsed time : " . (microtime(true) - $start_time) . " seconds\n";
            $start_time = microtime(true);

            $response = Http::withHeaders(['x-api-version' => '2'])->get(
                "http://api.ratings.food.gov.uk/Establishments?businessTypeId={$business_type_id}&maxDistanceLimit=20&sortOptionKey=Distance&pageNumber={$page_number}&pageSize=200&localAuthorityId=180"
            )->json()['establishments'];

            $end_time = (microtime(true) - $start_time);
            echo "Page " . $page_number . " read took: " . $end_time . "seconds\n";
            $start_time = microtime(true);

            foreach ($response as $item) {
                $address = self::concatAddress($item);

                $data = [
                    'fhrs_id' => $item['FHRSID'],
                    'business_name' => $item['BusinessName'],
                    'address' => $address,
                    'post_code' => $item['PostCode'],
                    'rating_value' => $item['RatingValue'],
                    'latitude' => $item['geocode']['latitude'],
                    'longitude' => $item['geocode']['longitude'],
                ];
                if (strlen($data['rating_value']) > 1) {
                    $data['rating_value'] = '-1';
                }
                Establishment::updateOrCreate(['fhrs_id' => $data['fhrs_id']], $data);
            }

            $end_time = (microtime(true) - $start_time);
            echo "Page " . $page_number . " upload took: " . $end_time . "seconds\n";
        }
    }

    public static function index()
    {
        $start_time = microtime(true);

        $business_type_ids = [
            'takeaway' => 7844,
            'restaurant' => 1
        ];

        foreach($business_type_ids as $business_type_id) {
            echo "Now processing " . array_search($business_type_id, $business_type_ids) . "s.\n";
            self::consumeToDatabase($business_type_id, $start_time);
        }
        echo "Time to complete : " . (microtime(true) - $start_time) . " seconds";
    }
}
