<?php

namespace App\Http\Controllers;

use App\Models\Oauth;
use App\Models\User;
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
        $oauthData = Socialite::driver('google')->user();

        if (Auth::user()) {

            Oauth::firstOrCreate([
                'user_id'   => Auth::id(),
                'provider'  => 'google',
                'access_token'  => $oauthData->token,
                'refresh_token' => $oauthData->refreshToken
            ]);

            return redirect()->route('home');
        }

        // Check if user already has account
        $users = User::whereHas('oauth', function ($query) use (&$oauthData) {
            $query->where('access_token', $oauthData->token);
        })->first();

        dd($oauthData);

        if ($users) {
            Auth::loginUsingId($users->id);

            return redirect()->route('home');
        }

        // // Create User
        // $createUser = User::create([
        //     'name' => $oauthData->getName(),
        //     'email' => $oauthData->getEmail(),
        // ]);

        // $createUser->oauth()->create([
        //     'provider'  => 'google',
        //     'access_token'  => $oauthData->token,
        //     'refresh_token' => $oauthData->refreshToken
        // ]);

        // Auth::loginUsingId($createUsers->id);

        // return redirect()->route('home');

        return redirect()->route('login');

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
