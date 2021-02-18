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
Use \Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Laravel OpenApi Demo Documentation",
     *      description="L5 Swagger OpenApi description",
     *      @OA\Contact(
     *          email="tiennam1999hp@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     */

    public function redirectToProvider($driver) {
        return Socialite::driver($driver)->redirect();
    }

    public function handleGoogleCallback() {
        try {
            $getUser = Socialite::driver('google')->stateless()->user();
            $findUser = User::where('provider_id',$getUser->id)->orWhere('email', $getUser->email)->first();

            if($findUser) {
                Auth::login($findUser, true);

            }else{
//                $getUser->validate([
//                    'email' => ['required', 'unique:users,user_name,NULL,id,deleted_at,NULL'],
//                ]);
                $ava = $this->imageUploadPost($getUser, 'google');
                $newUser = User::create([
                    'name' => $getUser->name,
                    'user_name' => $getUser->name,
                    'email' => $getUser->email,
                    'provider_id'=> $getUser->id,
                    'provider' => 'google',
                    'avatar' => $ava,
                    'email_verified_at' => Carbon::now()
                ]);
                $pro1 = 'social';
                Auth::login($newUser);
                setcookie("social",$pro1);

            }
            return redirect()->route('users')->cookie("social","social");

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
        $pro = 'social';
        setcookie("social",$pro);

        return redirect()->route('users',[$pro])->cookie("social",$pro);
    }

    function createUser($getUser,$provider) {
        $user = User::where('provider_id',$getUser->id)->orWhere('email', $getUser->email)->first();
//        $validate = Validator::make(
//            $getUser->all(),
//            [
//                'email' => ['required', 'unique:users,user_name,NULL,id,deleted_at,NULL'],
//            ]);
//        if ($validate->fails()) {
//            return back()->withErrors($validate);
//        }

        if (!$user) {
            $ava = $this->imageUploadPost($getUser, 'facebook');
            $user = User::create([
                'name'     => $getUser->name,
                'email'    => $getUser->email,
                'provider' => $provider,
                'provider_id' => $getUser->id,
                'avatar' => $ava,
                'email_verified_at' => Carbon::now()
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

    function verify($id) {
        $user = User::whereId($id)->first();
        $user->email_verified_at = Carbon::now();
        $user->save();
        return view('login');
    }
}
