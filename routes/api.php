<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('maps/mapdata', function (Request $request) {
    return Storage::json('public/map_data.geojson');
});
