<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Auth;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;
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
            $ava = $this->imageUploadPost($getUser, 'google');

            if($findUser) {
                Auth::login($findUser, true);

            }else{
                $newUser = User::create([
                    'name' => $getUser->name,
                    'email' => $getUser->email,
                    'provider_id'=> $getUser->id,
                    'provider' => 'google',
                    'avatar' => $ava
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
        $ava = $this->imageUploadPost($getUser, 'facebook');

        if (!$user) {
            $user = User::create([
                'name'     => $getUser->name,
                'email'    => $getUser->email,
                'provider' => $provider,
                'provider_id' => $getUser->id,
                'avatar' => $ava
            ]);
        }

        return $user;
    }

    public function imageUploadPost($user, $provider) {

//            $this->validate($request, [
//                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            ]);
//            dd($request->image);
        $imageName = time() . '.jpg';
        if($provider == 'facebook') {
            $t = Storage::disk('s3')->put($imageName, file_get_contents('https://graph.facebook.com/' . $user->id . '/picture?type=large'), 'public');
        } else {
            $t = Storage::disk('s3')->put($imageName, file_get_contents($user->avatar), 'public');
        }
        Storage::disk('s3')->url($imageName);

        return $imageName;

    }

    function listUser(Request $request) {
        $perPage = request('perPage', config('user.paginate'));
        $users = User::orderBy('id', 'ASC')->paginate($perPage);

        if ($request->ajax()) {
            return view('load_users_data', compact('users'));
        }
        return view('users', compact('users', 'perPage'));
    }
}
