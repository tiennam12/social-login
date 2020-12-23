<?php

namespace App\Repositories\Write;
use Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Auth;

use App\Models\User as User;

class UserRepository
{
    public static function deleteUser($id) {
        $user = User::findOrFail($id);

        if($user){
            $user->delete();
            $imageUrl = $user->avatar;
            Storage::disk('s3')->delete($imageUrl);
        }
    }

    public static function updateUser($request,$id) {
        $user = User::find($id);
        $user->name = $request->name;
        $user->provider = $request->provider;
        $user->provider_id = $request->provider_id;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->updated_at = Carbon\Carbon::now();

        $user->save();
    }

    public static function insertUser($request) {
        $avatar = self::storeAva($request);
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'user_name' => $request['user_name'],
            'gender' => $request['gender'],
            'provider_id' => time(),
            'provider' => 'another',
            'avatar' => $avatar
        ]);
        Auth::login($user,true);
        $user->sendEmailVerificationNotification();
        $user->save();
    }

    public static function storeAva($data) {
        if ($data['avatar'] == 'undefined'){
            $imageName = 'https://mybuckettiennam12.s3-ap-southeast-1.amazonaws.com/765-default-avatar.jpeg';
        } else {
            $imageName = time() . '.jpg';
            $t = Storage::disk('s3')->put($imageName, file_get_contents($data['avatar']), 'public');
            Storage::disk('s3')->url($imageName);
        }

            return $imageName;

    }
}
