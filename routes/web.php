<?php

use App\Http\Controllers\OauthController;
use App\Models\Oauth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/oauth/login/{driver}', [OauthController::class, 'redirect'])->name('oauth');

// Callback Oauth
Route::get('oauth/google/callback', [OauthController::class, 'google']);
Route::get('oauth/facebook/callback', [OauthController::class, 'facebook']);