<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\S3ImageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
    if ( Auth::check() ) {
        return redirect()->route('users');
    } else {
        return view('login');
    }
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
//Route::get('home', [HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

//Route::get('/home', [Controller::class, 'listUser'])->name('home');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/users', [Controller::class, 'listUser'])->name('users');

Route::get('send-email/{user}', [EmailController::class, 'sendEmail']);

//Route::get('register', function () {
//    return view('registration');
//});
//
//Route::post('register', [RegisterController::class, 'store'])->name('register');
