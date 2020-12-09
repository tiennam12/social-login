<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Auth;
use Socialite;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function redirectToProvider($driver) {
        return Socialite::driver($driver)->redirect();
    }

    public function handleGoogleCallback() {
        try {
            $getUser = Socialite::driver('google')->stateless()->user();
            $findUser = User::where('provider_id',$getUser->id)->first();

            if($findUser) {
                Auth::login($findUser, true);

            }else{
                $newUser = User::create([
                    'name' => $getUser->name,
                    'email' => $getUser->email,
                    'provider_id'=> $getUser->id,
                    'provider' => 'google',
                    'avatar' => $getUser->avatar
                ]);

                Auth::login($newUser);

            }
            return redirect()->route('users');

        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }

    public function redirect($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider) {
        $getUser = Socialite::driver($provider)->stateless()->user();
        $user = $this->createUser($getUser,$provider);
        auth()->login($user);

        return redirect()->route('users');
    }

    function createUser($getUser,$provider) {
        $user = User::where('provider_id',$getUser->id)->first();

        if (!$user) {
            $user = User::create([
                'name'     => $getUser->name,
                'email'    => $getUser->email,
                'provider' => $provider,
                'provider_id' => $getUser->id
            ]);
        }
        return $user;
    }

    function listUser(Request $request)
    {
        $perPage = request('perPage', 2);
        $users = User::orderBy('id', 'ASC')->paginate($perPage);

        if ($request->ajax()) {
            return view('load_users_data', compact('users'));
        }
//        dd($perPage);
        return view('users', compact('users', 'perPage'));
    }
}
