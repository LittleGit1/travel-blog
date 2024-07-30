<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    function create(Request $request)
    {
        if ($request->has('redirect')) {
            session(['url.intended' => $request->input('redirect')]);
        }

        return view('auth.index');
    }

    function destroy()
    {
        if(!Auth()->user())
           return abort(401);

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/blog/posts');
    }

    function authenticate(Request $request)
    {
        $credentials = $request->validate([
            "email" => ['required', 'email'],
            "password" => ['required']
        ]);

        if(Auth::attempt($credentials)){

            $url = null;
            if (session()->has("url.intended"))
                $url = session()->get('url.intended');

            $request->session()->regenerate();

            if(!$url) return redirect()->intended('blog/posts');

            return redirect()->intended($url);

        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
    }
}
