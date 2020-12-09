<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $_user;

    public function __construct(UserService $user)
    {
        $this->_user = $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return $this->_user->showUser($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        return $this->_user->updateUser($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id) {
        return $this->_user->deleteUser($id);
    }
}
