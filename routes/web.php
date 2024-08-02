<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('blog/posts', [BlogController::class, 'index']);
Route::get('blog/posts/create', [BlogController::class, 'create'])->middleware(['auth']);
Route::post('blog/posts/create', [BlogController::class, 'store'])->middleware(['auth']);
Route::get('blog/posts/{post:slug}', [BlogController::class, 'show']);
Route::put('blog/posts/{post:slug}', [BlogController::class, 'update'])->middleware(['auth']);
Route::delete('blog/posts/{post:slug}', [BlogController::class, 'destroy'])->middleware(['auth']);
Route::get('blog/posts/{post:slug}/edit', [BlogController::class, 'edit'])->middleware(['auth']);
Route::get('blog/posts/user/{user:external_id}', [BlogController::class, 'index_user']);
Route::post('blog/posts/{post}/like', [LikeController::class, 'like'])->middleware('auth');
Route::post('blog/posts/{post}/comment', [CommentController::class, 'store'])->middleware('auth');

Route::get('account/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('account/posts', [DashboardController::class, 'posts'])->middleware('auth');
Route::get('account/users', [DashboardController::class, 'users'])->middleware(['auth', Admin::class]);


Route::get('auth', [LoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('auth', [LoginController::class, 'authenticate'])->middleware('guest');
Route::delete('auth', [LoginController::class, 'destroy'])->middleware('auth');

Route::get('signup', [UserController::class, 'create'])
    ->middleware('guest')
    ->name('signup');

Route::post('signup', [UserController::class, 'store'])
    ->middleware('guest');

Route::get('admin', function () {
    return view('admin.dashboard.index', [
        'title' => "Dashboard"
    ]);
})->middleware(['auth', Admin::class]);

Route::get(
    'admin/blog/categories',
    [PostCategoryController::class, 'index']
)->middleware(['auth', Admin::class]);

Route::get(
    'admin/blog/categories/create',
    [PostCategoryController::class, 'create']
)->middleware(['auth', Admin::class]);

Route::post(
    'admin/blog/categories/create',
    [PostCategoryController::class, 'store']
)->middleware(['auth', Admin::class]);

Route::put(
    'admin/blog/categories/{slug}',
    [PostCategoryController::class, 'update']
)->middleware(['auth', Admin::class]);

Route::get(
    'admin/blog/categories/{slug}/edit',
    [PostCategoryController::class, 'edit']
)->middleware(['auth', Admin::class]);





// create
// edit
// destroy
// show
// index
// update
// store
