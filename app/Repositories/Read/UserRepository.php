<?php

namespace App\Repositories\Read;

use App\Models\User as  User;

class UserRepository {
    public static function showUser($id) {
        $user = User::findOrFail($id);

        return $user;
    }
}
