<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $finduser = User::where('google_id', $googleUser->id)->first();

        if ($finduser) {
            Auth::login($finduser);

            return redirect()->intended('/dashboard');
        } else {
            $newUser = User::updateOrCreate(['email' => $googleUser->email], [
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
                'password' => Hash::make('password')
            ]);

            Auth::login($newUser);
        }

        // $user = User::updateOrCreate([
        //     'google_id' => $googleUser->id,
        // ], [
        //     'name' => $googleUser->name,
        //     'email' => $googleUser->email,
        //     'password' => Hash::make('password'),
        // ]);

        // Auth::login($user);

        return redirect('/');
    }
}
