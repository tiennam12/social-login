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
     * @OA\Post(
     *      path="/api/users",
     *      tags={"User"},
     *      summary="create user",
     *      description="Returns updated project data",
     *     @OA\RequestBody(
     *     * required=true,
     *     @OA\JsonContent(

     *          required={"avatar", "name","password","username","confirm_password","gender","email"},
     *          @OA\Property(property="name", type="string", format="name", example="namnam1234"),
     *          @OA\Property(property="password", type="string", format="name", example="12345678"),
     *          @OA\Property(property="confirm_password", type="string", format="name", example="12345678"),
     *          @OA\Property(property="user_name", type="string", format="name", example="namnam1234test"),
     *          @OA\Property(property="email", type="string", format="email", example="tiennam1999hp123@gmail.com"),
     *          @OA\Property(property="gender", type="string", format="name", example="male"),
     *     @OA\Property(property="avatar", type="string", format="binary", example="https://iupac.org/wp-content/uploads/2018/05/default-avatar.png")
     *      ),
     *
     *     ),

     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="")
     *       ),
     *      @OA\Response(
     *          response=406,
     *          description="Not Acceptable"
     *      )
     * )
     */

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'avatar' => ['required'],
            'name' => ['required'],
            'gender' => ['required'],
            'user_name' => ['required', 'unique:users,user_name,NULL,id,deleted_at,NULL'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,NULL,id,deleted_at,NULL'],
            'password' => ['required', 'string', 'min:8']
        ]);
//        Mail::to($request['email'])->send(new MailNotify($request));

        if($validator->fails()) {
            $error = $validator->errors()->toJson();

            return response()->json($error,406);
        } else if($request['password'] != $request['confirm_password']) {
            return response()->json('confirm password not match',406);
        }
        else {
            return $this->_user->createUser($request);
        }
    }


    /**
     * @OA\Get(
     *     path="/api/users/{user}",
     *     tags={"User"},
     *     *      @OA\Parameter(
     *          name="user",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              example="99"
     *          )
     *      ),
     *           @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found"
     *      ),
     * )
     */

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
     * @OA\Put(
     *      path="/api/users/{user}",
     *      tags={"User"},
     *      summary="Update existing user",
     *      description="Returns updated user data",
     *     * @OA\Parameter(
     *          name="user",
     *          description="user id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     * @OA\Parameter(
     *          name="name",
     *          description="User name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     * @OA\Parameter(
     *          name="email",
     *          description="User email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     * @OA\Parameter(
     *          name="status",
     *          description="user status",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="provider",
     *          description="provider",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="provider_id",
     *          description="provider id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */


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
     * @OA\Delete(
     *      path="/api/users/{user}",
     *      tags={"User"},
     *      summary="Delete existing user",
     *      description="Delete user",
     *      @OA\Parameter(
     *          name="user",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *     example="106"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="delete user success",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id) {
        return $this->_user->deleteUser($id);
    }

    /**
     * @OA\Post( * path="/api/login", * summary="Sign in", * description="Login by email, password", * operationId="authLogin", * tags={"auth"}, * @OA\RequestBody( * required=true, * description="Pass user credentials", * @OA\JsonContent( * required={"email","password"}, * @OA\Property(property="email", type="string", format="email", example="tiennam1999hp@gmail.com"), * @OA\Property(property="password", type="string", format="password", example="123456789"),  * ), * ),
     * @OA\Response( * response=200, * description="Success", * @OA\JsonContent( * @OA\Property(property="message", type="string", example="Success") * ) * ),
     * @OA\Response( * response=401, * description="Unauthorized", * @OA\JsonContent( * @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again") * ) * ) * ) */


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
