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
     * @OA\Get(
     *     path="/api/users/{user}",
     *     tags={"User"},
     *     @OA\Response(response="200", description="success"),
     *     *      @OA\Parameter(
     *          name="user",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
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
     *      @OA\Examples(
     *        summary="VehicleStoreEx2",
     *        example = "VehicleStoreEx2",
     *       value = {
     *              "name": "vehicle 1",
     *              "model": "Tesla"
     *         },
     *      )
     */

    /**
     * @OA\Put(
     *      path="/api/users/{user}",
     *      operationId="updateProject",
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
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
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
     *              type="integer"
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
     * @OA\Post(
     *      path="/api/users",
     *      operationId="updateProject",
     *      tags={"User"},
     *      summary="create user",
     *      description="Returns updated project data",
     *     * @OA\Parameter(
     *          name="id",
     *          description="Project id",
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
     *          name="avatar",
     *          description="avatar",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="file"
     *          )
     *      ),
     *     * @OA\Parameter(
     *          name="user_name",
     *          description="User name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     * @OA\Parameter(
     *          name="password",
     *          description="password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     * @OA\Parameter(
     *          name="confirm_password",
     *          description="confirm password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     * @OA\Parameter(
     *          name="gender",
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
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
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
        }
        else {

            return $this->_user->createUser($request);

        }
    }
/**
*    @OA\Post(
*    path="/api/login",
*    tags={"Login"},
*    summary="Login",
*              operationId="login",
*
*              @OA\Parameter(
*                  name="email",
*                  in="query",
*                  required=true,
*                  @OA\Schema(
*                      type="string"
*                  )
*              ),
*              @OA\Parameter(
*                  name="password",
*                  in="query",
*                  required=true,
*                  @OA\Schema(
*                      type="string"
*                  )
*              ),
*              @OA\Response(
*                  response=200,
*                  description="Success",
*                  @OA\MediaType(
*                      mediaType="application/json",
*                  )
*              ),
*              @OA\Response(
*                  response=401,
*                  description="Unauthorized"
*              ),
*              @OA\Response(
*                  response=400,
*                  description="Invalid request"
*              ),
*              @OA\Response(
*                  response=404,
*                  description="not found"
*              ),
*          )
**/

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
