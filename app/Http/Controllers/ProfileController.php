<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController
{
    public function index()
    {
        return view('account.profile.index', ['title' => 'Profile', 'user' => Auth::user()]);
    }

    public function avatar_update(Request $request)
    {
        $request->validate([
            'profile_avatar' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $user = User::find($request->user()->id);

        if (!is_null($user->avatar)) {
            if (Storage::exists($user->avatar)) Storage::delete($user->avatar);
        }

        $path = $request->file('profile_avatar')->store('public/img/avatars');

        $user->avatar = $path;
        $user->update();

        return redirect('/account/profile');
    }

    public function password_edit()
    {
        return view('account.password.edit', ['title' => 'Change password']);
    }

    public function password_update(Request $request)
    {
        $values = $request->validate([
            'old_password'  => 'required',
            'new_password'  => 'required|string|min:8|regex:/[a-zA-Z]/|regex:/[0-9]/|regex:/[@$!%*?&#]/',
            'retype_password'   => 'required|same:new_password'
        ]);

        $user = User::find(Auth::user()->id);

        if (!Hash::check($values['old_password'], $user->password))
            return back()->withErrors(['incorrect_password' => "Old password is incorrect"]);

        $user->password = Hash::make($values['new_password']);
        $user->update();

        return redirect('/account/profile');
    }

    public function profile_edit()
    {
        return view('account.profile.edit', ["title" => "Edit profile"]);
    }

    public function profile_update(Request $request)
    {

        $user = Auth::user();

        $rules = [];

        if ($request->input('name') !== $user->name) $rules['name'] = 'required|string|max:255';

        if ($request->input('email') !== $user->email) $rules['email'] = 'required|email|unique:users';

        $values = $request->validate($rules);

        if (isset($rules['name'])) $user->name = $values['name'];

        if (isset($rules['email'])) $user->email = $values['email'];

        if (count($rules) > 0) $user->update();

        return redirect('/account/profile');
    }

    public function profile_destroy(Request $request)
    {

        $user = Auth::user();

        if ($request->user()->cannot('delete', Auth::user())) abort(403);

        Auth::logout();

        $user->delete();

        return redirect('/');
    }
}
