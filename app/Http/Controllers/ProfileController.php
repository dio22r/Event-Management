<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit_password()
    {
        return view(
            "profile.change_password",
        );
    }

    public function update_password(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if (
            Hash::check($request->old_password, $user->password)
            && $request->password == $request->re_password
        ) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect('/profile');
        } else {
            return redirect('/password');
        }
    }
}
