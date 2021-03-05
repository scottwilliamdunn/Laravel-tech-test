@extends('layout')

@section('body')

    @include('search-bar')

    <div class="row">
        <div class="col-12">

            <h1 class="my-4">Search Result For:
                <small>{{$key}}</small>
            </h1>
            @if($establishments == null)
                <ln>This search has yielded no results</ln>


            @else
                <table style="width:100%" class="table table-striped">
                    <tr>
                        <th>FHRS ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Rating</th>
                        <th>Distance</th>
                    </tr>
                    @foreach($establishments as $establishment)
                        <tr>
                            <td>{{$establishment['fhrs_id']}}</td>
                            <td>{{$establishment['business_name']}}</td>
                            <td>{{$establishment['address'] . "\n" . $establishment['post_code']}}</td>
                            <td>
                                @if($establishment['rating_value']>=1)
                                    {{$establishment['rating_value']}}
                                @else
                                    No rating.
                                @endif
                            </td>

                            <td>{{ round($establishment['distance'], 2) . "km" }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif

        </div>
    </div>

@endsection
