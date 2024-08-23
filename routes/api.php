<?php

use App\Http\Controllers\Api\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('maps/mapdata', function (Request $request) {
    return Storage::json('public/map_data.geojson');
});

Route::post('blog/posts/{post}/like', [BlogController::class, 'post_like'])->middleware('auth');
