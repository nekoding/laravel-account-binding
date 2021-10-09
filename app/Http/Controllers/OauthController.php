<?php

namespace App\Http\Controllers;

use App\Models\Oauth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function redirect($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function google()
    {
        $user = Socialite::driver('google')->user();

        Oauth::firstOrCreate([
            'user_id'   => Auth::id(),
            'provider'  => 'google',
            'access_token'  => $user->token,
            'refresh_token' => $user->refreshToken
        ]);

        return redirect()->route('home');
    }

    public function facebook()
    {
        $user = Socialite::driver('facebook')->user();

        Oauth::firstOrCreate([
            'user_id'   => Auth::id(),
            'provider'  => 'facebook',
            'access_token'  => $user->token,
            'refresh_token' => $user->refreshToken
        ]);

        return redirect()->route('home');
    }
}
