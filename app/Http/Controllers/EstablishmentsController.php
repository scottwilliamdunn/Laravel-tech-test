<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class EstablishmentsController extends Controller
{
    private function findNearestEstablishments($latitude, $longitude, $radius, $sort) {
        $establishments = Establishment::selectRaw("id, business_name, fhrs_id, address, post_code, rating_value, latitude, longitude,
                     ( 6371 * acos( cos( radians(?) ) *
                       cos( radians( latitude ) )
                       * cos( radians( longitude ) - radians(?)
                       ) + sin( radians(?) ) *
                       sin( radians( latitude ) ) )
                     ) AS distance", [$latitude, $longitude, $latitude])
            ->having("distance", "<", $radius)
            ->orderBy($sort['type'], $sort['ascOrDesc'])
            ->orderBy("distance", 'asc')
            ->get();
        return $establishments;
    }

    private function sortType($sortOption) {
        switch ($sortOption) {
            case "distance":
                return [
                    'type' => "distance",
                    'ascOrDesc' => 'asc'
                ];
            case "a-z":
                return [
                    'type' => "business_name",
                    'ascOrDesc' => 'asc'
                ];
            case "z-a":
               return [
                    'type' => "business_name",
                    'ascOrDesc' => 'desc'
                ];
            case "rating":
                return [
                    'type' => "rating_value",
                    'ascOrDesc' => 'desc'
                ];
        }
        return null;
    }

    private static function getLatAndLon($location) {
        $latAndLon[] = array(2);
        $response = json_decode(
            Http::get("https://nominatim.openstreetmap.org/search?q={$location}&format=json&limit=1")->body()
        );
        if($response == null) {
            $latAndLon[0] = false;
            $latAndLon[1] = false;
        } else {
            $latAndLon[0] = $response[0]->lat;
            $latAndLon[1] = $response[0]->lon;
        }
        return $latAndLon;
    }

    public function search(Request $request)
    {

        $key = $request->validate(
            [
                'q' => 'required'
            ]
        )['q'];

        $sort_by = $request->get('sort_by');
        $sortParams = self::sortType($sort_by);

        $radius = $request->get('radius');

        $latAndLon = self::getLatAndLon($key);

        if(!$latAndLon[0])  {
            $keyTry2 = substr($key, 0, strlen($key) - 3) . " " . substr($key, strlen($key) - 3, strlen($key));
            $latAndLon = self::getLatAndLon($keyTry2);
        }

        if(!$latAndLon[0]) {
            $establishments = null;
            return view('search', [
                'establishments' => $establishments,
                'key' => $key,
                'results' => false
            ]);
        }
        $establishments = self::findNearestEstablishments($latAndLon[0], $latAndLon[1], $radius, $sortParams);

        return view('search', [
            'key' =>  $key,
            'establishments' => $establishments,
            'results' => true,
            'radius' => $radius,
            'sort_by' => $sort_by
        ]);
    }

//    public function render($request, Exception $exception)
//    {
//        // This will replace our 404 response with
//        // a JSON response.
//        if ($exception instanceof ModelNotFoundException) {
//            return response()->json([
//                                        'error' => 'Resource not found'
//                                    ], 404);
//        }
//
//        return parent::render($request, $exception);
//    }
//
//    public function index()
//    {
//        return Establishment::all();
//    }
//
//    public function show(Article $establishment)
//    {
//        return $establishment;
//    }
//
//    public function store(Request $request)
//    {
//        $establishment = Establishment::create($request->all());
//
//        return response()->json($establishment, 201);
//    }
//
//    public function update(Request $request, Establishment $establishment)
//    {
//        $establishment->update($request->all());
//
//        return response()->json($establishment, 200);
//    }
//
//    public function delete(Establishment $establishment)
//    {
//        $establishment->delete();
//
//        return response()->json(null, 204);
//    }
}
