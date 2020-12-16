<?php

namespace App\Repositories\Write;
use Carbon;
use Illuminate\Support\Facades\Storage;

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
}
