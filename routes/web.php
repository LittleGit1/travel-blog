<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Jobs\GenerateGeojson;
use App\Models\Country;
use App\Models\Flight;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('journey', function () {
    return view('journey');
})->name('journey');

Route::get('blog/posts', [BlogController::class, 'index'])->name('posts.index');
Route::get('blog/posts/create', [BlogController::class, 'create'])->middleware(['auth'])->name('posts.create');
Route::post('blog/posts/create', [BlogController::class, 'store'])->middleware(['auth'])->name('posts.store');
Route::get('blog/posts/{post:slug}', [BlogController::class, 'show'])->name('posts.show');
Route::put('blog/posts/{post:slug}', [BlogController::class, 'update'])->middleware(['auth'])->name('posts.update');
Route::delete('blog/posts/{post:slug}', [BlogController::class, 'destroy'])->middleware(['auth'])->name('posts.destroy');
Route::get('blog/posts/{post:slug}/edit', [BlogController::class, 'edit'])->middleware(['auth'])->name('posts.edit');
Route::get('blog/posts/user/{user:username}', [BlogController::class, 'index_user'])->name('posts.users.index');

Route::get('account', [AccountController::class, 'index'])->middleware('auth')->name('account.index');
Route::get('account/posts', [AccountController::class, 'posts'])->middleware('auth')->name('account.posts');
Route::get('account/users', [AccountController::class, 'users'])->middleware(['auth', Admin::class])->name('account.users');

Route::get('account/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile.index');
Route::patch('account/profile', [ProfileController::class, 'profile_update'])->middleware('auth')->name('profile.update');
Route::patch('account/profile/avatar', [ProfileController::class, 'avatar_update'])->middleware('auth')->name('avatar.update');
Route::get('account/profile/edit', [ProfileController::class, 'profile_edit'])->middleware('auth')->name('profile.edit');
Route::get('account/password', [ProfileController::class, 'password_edit'])->middleware('auth')->name('profile.password.edit');
Route::patch('account/password', [ProfileController::class, 'password_update'])->middleware('auth')->name('profile.password.store');
Route::delete('account/delete', [ProfileController::class, 'profile_destroy'])->middleware('auth')->name('profile.destroy');

Route::get('account/journey', function () {
    return view('account.journey.index', [
        'title' => "Journey",
        'flights' => Flight::orderBy('created_at', 'ASC')->get(),
        'countries' => Country::with('cities')->orderBy('created_at', "ASC")->get(),
    ]);
})->middleware(['auth', Admin::class])->name('journey.index');

Route::get('account/journey/flights/create', [FlightController::class, 'create'])->middleware(['auth', Admin::class])->name('flights.create');
Route::post('account/journey/flights/create', [FlightController::class, 'store'])->middleware(['auth', Admin::class])->name('flights.store');
Route::get('account/journey/flights/{flight}/edit', [FlightController::class, 'edit'])->middleware(['auth', Admin::class])->name('flights.edit');
Route::put('account/journey/flights/{flight}', [FlightController::class, 'update'])->middleware(['auth', Admin::class])->name('flights.update');
Route::delete('account/journey/flights/{flight}', [FlightController::class, 'destroy'])->middleware(['auth', Admin::class])->name('flights.destroy');

Route::get('account/journey/countries/create', [CountryController::class, 'create'])->middleware(['auth', Admin::class])->name('countries.create');
Route::post('account/journey/countries/create', [CountryController::class, 'store'])->middleware(['auth', Admin::class])->name('countries.store');
Route::get('account/journey/countries/{country}/edit', [CountryController::class, 'edit'])->middleware(['auth', Admin::class])->name('countries.edit');
Route::put('account/journey/countries/{country}', [CountryController::class, 'update'])->middleware(['auth', Admin::class])->name('countries.update');
Route::delete('account/journey/countries/{country}', [CountryController::class, 'destroy'])->middleware(['auth', Admin::class])->name('countries.destroy');

Route::get('account/categories', [PostCategoryController::class, 'index'])->middleware(['auth', Admin::class])->name('categories.index');
Route::get('account/categories/create', [PostCategoryController::class, 'create'])->middleware(['auth', Admin::class])->name('categories.create');
Route::post('account/categories/create', [PostCategoryController::class, 'store'])->middleware(['auth', Admin::class])->name('categories.store');
Route::put('account/categories/{slug}', [PostCategoryController::class, 'update'])->middleware(['auth', Admin::class])->name('categories.update');
Route::get('account/categories/{slug}/edit', [PostCategoryController::class, 'edit'])->middleware(['auth', Admin::class])->name('categories.edit');

Route::get('auth', [LoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('auth', [LoginController::class, 'authenticate'])->middleware('guest')->name('auth.store');
Route::delete('auth', [LoginController::class, 'destroy'])->middleware('auth')->name('auth.destroy');

Route::get('signup', [UserController::class, 'create'])->middleware('guest')->name('signup');
Route::post('signup', [UserController::class, 'store'])->middleware('guest')->name('signup.store');
