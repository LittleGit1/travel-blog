<?php

namespace App\Jobs;

use App\Models\CountryDestination;
use App\Models\Flight;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GenerateGeojson implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = [
            "points"    => [
                "type" => "FeatureCollection",
                "features" => []
            ],
            "lines" => []
        ];

        $flights = Flight::orderBy('created_at', "ASC")->get();
        $cities = CountryDestination::orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->get();

        $flightCoordinates = [];

        foreach ($flights as $flight) {
            $flightCoordinates[] = [
                "type" => "Feature",
                "geometry" => [
                    "type" => "LineString",
                    "coordinates" => [
                        [$flight->origin_lng, $flight->origin_lat],
                        [$flight->destination_lng, $flight->destination_lat]
                    ]
                ]
            ];
        }

        $data['lines'] = $flightCoordinates;

        $cityCoordinates = [];

        foreach ($cities as $city) {
            $cityCoordinates[] = [
                "type" => "Feature",
                "geometry"  => [
                    "type" => "Point",
                    "coordinates" => [$city->lng, $city->lat],
                ]
            ];
        }

        $data['points']['features'] = $cityCoordinates;

        Storage::disk('public')->put('map_data.geojson', json_encode($data));
    }
}
