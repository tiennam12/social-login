<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Mail;
use JWTAuth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'avatar' => ['required'],
            'name' => ['required'],
            'gender' => ['required'],
            'user_name' => ['required', 'unique:users,user_name,NULL,id,deleted_at,NULL'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,NULL,id,deleted_at,NULL'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
//        Mail::to($request['email'])->send(new MailNotify($request));

        if($validator->fails()) {
            $error = $validator->errors()->toJson();
            return response()->json($error,406);
        }
        else {

            return $this->_user->createUser($request);

        }
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['invalid_email_or_password'], 422);
            }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function getUserInfo(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }
    public function login1(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'status' => true,
            'token' => $token,
        ]);
    }
}
