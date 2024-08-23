<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Jobs\GenerateGeojson;
use App\Models\Country;
use App\Models\Flight;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('journey', function () {
    return view('journey');
});

Route::get('blog/posts', [BlogController::class, 'index']);
Route::get('blog/posts/create', [BlogController::class, 'create'])->middleware(['auth']);
Route::post('blog/posts/create', [BlogController::class, 'store'])->middleware(['auth']);
Route::get('blog/posts/{post:slug}', [BlogController::class, 'show']);
Route::put('blog/posts/{post:slug}', [BlogController::class, 'update'])->middleware(['auth']);
Route::delete('blog/posts/{post:slug}', [BlogController::class, 'destroy'])->middleware(['auth']);
Route::get('blog/posts/{post:slug}/edit', [BlogController::class, 'edit'])->middleware(['auth']);
Route::get('blog/posts/user/{user:external_id}', [BlogController::class, 'index_user']);

Route::get('account/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('account/posts', [DashboardController::class, 'posts'])->middleware('auth');
Route::get('account/users', [DashboardController::class, 'users'])->middleware(['auth', Admin::class]);

Route::get('account/journey', function () {
    return view('dashboard.journey.index', [
        'title' => "Journey",
        'flights' => Flight::orderBy('created_at', 'ASC')->get(),
        'countries' => Country::with('cities')->orderBy('created_at', "ASC")->get(),
    ]);
})->middleware(['auth', Admin::class]);

Route::get('account/journey/flights/create', [FlightController::class, 'create'])->middleware(['auth', Admin::class]);
Route::post('account/journey/flights/create', [FlightController::class, 'store'])->middleware(['auth', Admin::class]);
Route::get('account/journey/flights/{flight}/edit', [FlightController::class, 'edit'])->middleware(['auth', Admin::class]);
Route::put('account/journey/flights/{flight}', [FlightController::class, 'update'])->middleware(['auth', Admin::class]);
Route::delete('account/journey/flights/{flight}', [FlightController::class, 'destroy'])->middleware(['auth', Admin::class]);

Route::get('account/journey/countries/create', [CountryController::class, 'create'])->middleware(['auth', Admin::class]);
Route::post('account/journey/countries/create', [CountryController::class, 'store'])->middleware(['auth', Admin::class]);
Route::get('account/journey/countries/{country}/edit', [CountryController::class, 'edit'])->middleware(['auth', Admin::class]);
Route::put('account/journey/countries/{country}', [CountryController::class, 'update'])->middleware(['auth', Admin::class]);
Route::delete('account/journey/countries/{country}', [CountryController::class, 'destroy'])->middleware(['auth', Admin::class]);

Route::get('account/categories', [PostCategoryController::class, 'index'])->middleware(['auth', Admin::class]);
Route::get('account/categories/create', [PostCategoryController::class, 'create'])->middleware(['auth', Admin::class]);
Route::post('account/categories/create', [PostCategoryController::class, 'store'])->middleware(['auth', Admin::class]);
Route::put('account/categories/{slug}', [PostCategoryController::class, 'update'])->middleware(['auth', Admin::class]);
Route::get('account/categories/{slug}/edit', [PostCategoryController::class, 'edit'])->middleware(['auth', Admin::class]);

Route::get('auth', [LoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('auth', [LoginController::class, 'authenticate'])->middleware('guest');
Route::delete('auth', [LoginController::class, 'destroy'])->middleware('auth');

Route::get('signup', [UserController::class, 'create'])->middleware('guest')->name('signup');
Route::post('signup', [UserController::class, 'store'])->middleware('guest');
