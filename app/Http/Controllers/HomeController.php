<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();

        $googleAccount = $user->parseOauthData()->firstWhere('provider', 'google');

        $facebookAccount = $user->parseOauthData()->firstWhere('provider', 'facebook');

        return view('home', compact('user', 'googleAccount', 'facebookAccount'));
    }
}
