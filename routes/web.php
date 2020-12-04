<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Models\User;
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
    return view('login');
});
Route::get('login', function () {
    return view('login');
});
Route::get('redirect/{driver}', [Controller::class, 'redirectToProvider'])
    ->name('login.provider')
    ->where('driver', implode('|', config('auth.socialite.drivers')));
Route::get('google/callback', [Controller::class, 'handleGoogleCallback']);
Route::get('/auth/redirect/{provider}', [Controller::class, 'redirect']);
Route::get('/callback/{provider}', [Controller::class, 'callback']);
Route::get('home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [Controller::class, 'listUser'])->name('home');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
