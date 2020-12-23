<?php

namespace App\Service;

use App\Repositories\Read\UserRepository as readUser;
use App\Repositories\Write\UserRepository as writeUser;

class UserService
{
    protected $_readUser;
    protected $_writeUser;
    protected $_response;

    public function __construct(readUser $readUser, writeUser $writeUser,ResponseService $response)
    {
        $this->_readUser = $readUser;
        $this->_writeUser = $writeUser;
        $this->_response = $response;
    }

    public function showUser($id) {
        $this->_response->data = $this->_readUser::showUser($id);
        $this->_response->success = true;
        $this->_response->message = __('success');

        return response()->json($this->_response, 200);
    }

    public function createUser($request)
    {
        $this->_response->data = $this->_writeUser::insertUser($request);
        $this->_response->success = true;
        $this->_response->message = __('update user success');

        return response()->json($this->_response, 201);
    }

    public function updateUser($request,$id) {
        $this->_response->data = $this->_writeUser::updateUser($request,$id);
        $this->_response->success = true;
        $this->_response->message = __('update user success');

        return response()->json($this->_response, 200);
    }

    public function deleteUser($id) {
        $this->_response->data = $this->_writeUser::deleteUser($id);
        $this->_response->success = true;
        $this->_response->message = __('delete user success');

        return response()->json($this->_response, 204);
    }
}
