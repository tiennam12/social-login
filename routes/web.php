<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\S3ImageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\UserController;

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
    if ( isset($_COOKIE["jwt_token"]) ) {
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
//Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth.jwt');

Auth::routes(['verify' => true]);

//Route::get('/home', [Controller::class, 'listUser'])->name('home');
Route::get('logout', [LoginController::class, 'logout1'])->name('logout');

Route::get('/users', [Controller::class, 'listUser'])->middleware('add')->name('users')->middleware('auth.jwt');

Route::get('send-email/{user}', [EmailController::class, 'sendEmail']);
Route::get('verify', function() { return view('auth.verify');});


Route::get('test', [UserController::class, 'getUserInfo']);
Route::get('email/verify/{id}', 'Controller@verify')->name('verification.verify');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth.jwt')->name('home');
