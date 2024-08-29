<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateGeojson;
use App\Models\Country;
use App\Models\CountryDestination;
use Illuminate\Http\Request;

class CountryController
{
    public function create()
    {
        return view('account.journey.countries.create');
    }

    public function store(Request $request)
    {
        $values = $request->validate([
            'country_name'  => 'required',
            'cities'        => 'array',
            'cities.*.name' => 'string|max:255',
            'cities.*.latitude' => 'string',
            'cities.*.longitude' => 'string',
        ]);

        $newCountry = Country::create([
            'name'  => $values['country_name']
        ]);

        $cities = $request->cities;


        $names = explode(',', $cities[0]['name']);
        $latitudes = explode(',', $cities[1]['latitude']);
        $longitudes = explode(',', $cities[2]['longitude']);

        for ($i = 0; $i < count($names); $i++) {
            CountryDestination::create([
                'country_id' => $newCountry->id,
                'name'      => $names[$i],
                'lat'  => $latitudes[$i],
                'lng' => $longitudes[$i],
            ]);
        }

        GenerateGeojson::dispatch();

        return redirect('/account/journey');
    }

    public function edit(Country $country)
    {
        return view('account.journey.countries.edit', ['country' => $country, 'cities' => json_encode($country->cities)]);
    }

    public function update(Request $request, Country $country)
    {
        GenerateGeojson::dispatch();
    }

    public function destroy(Country $country)
    {
        //policy??
        $country->delete();

        GenerateGeojson::dispatch();

        return redirect('/account/journey');
    }
}
