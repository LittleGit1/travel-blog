<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index', [
            'title' => "Dashboard"
        ]);
    }

    public function posts(){
        return view('dashboard.posts.index', [
            'title' => "Manage posts",
            "posts" => Post::where("user_id", Auth::id())->paginate(10),
        ]);
    }

    public function users(){
        return view('dashboard.users.index', [
            'title' => "Manage users",
            "users" => User::paginate(10),
        ]);
    }
}
