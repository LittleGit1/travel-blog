<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateGeojson;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController
{

    public function create()
    {
        return view('account.journey.flights.create');
    }


    public function store(Request $request)
    {
        $values = $request->validate([
            'origin_name'   => 'required',
            'destination_name'  => 'required',
            'origin_lat'    => 'required',
            'origin_lng'    => 'required',
            'destination_lat'   => 'required',
            'destination_lng'   => 'required'
        ]);

        Flight::create([
            'origin_name'       => $values['origin_name'],
            'destination_name'  => $values['destination_name'],
            'origin_lat'        => $values['origin_lat'],
            'origin_lng'        => $values['origin_lng'],
            'destination_lat'   =>  $values['destination_lat'],
            'destination_lng'   =>  $values['destination_lng']
        ]);

        //Queue job to recreate the GEOJSON file
        GenerateGeojson::dispatch();


        return redirect('account/journey')->with('success', "Successfully created flight.");
    }

    public function edit(Flight $flight)
    {
        return view('account.journey.flights.edit', [
            'flight' => $flight
        ]);
    }

    public function update(Request $request, Flight $flight)
    {
        $values = $request->validate([
            'origin_name'   => 'required',
            'destination_name'  => 'required',
            'origin_lat'    => 'required',
            'origin_lng'    => 'required',
            'destination_lat'   => 'required',
            'destination_lng'   => 'required'
        ]);

        $flight->origin_name = $values['origin_name'];
        $flight->destination_name = $values['destination_name'];
        $flight->origin_lat = $values['origin_lat'];
        $flight->origin_lng = $values['origin_lng'];
        $flight->destination_lat = $values['destination_lat'];
        $flight->destination_lng = $values['destination_lng'];
        $flight->save();

        //Queue job to recreate the GEOJSON file
        GenerateGeojson::dispatch();

        return redirect('account/journey');
    }

    public function destroy(Flight $flight)
    {
        //Make a policy for this 
        $flight->delete();

        //Queue job to recreate the GEOJSON file
        GenerateGeojson::dispatch();

        return back();
    }
}
