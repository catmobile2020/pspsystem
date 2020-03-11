<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Resources\AccountResource;
use App\Mail\ResetPasswordMail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{


    public function __construct()
    {
        $guard = explode('/',request()->route()->uri())[2];
        if ($guard == 'users')
        {
            $guard ='api';
        }else
        {
            $this->guard = $guard;
        }
        $this->middleware('auth:'.$guard, ['except' => ['login','register','resetPassword']]);
        auth()->shouldUse($guard);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"users auth (patient , doctor)"},
     *      path="/auth/users/login",
     *      summary="login",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Parameter(
     *         name="username",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="patient",
     *      ),
     *      @SWG\Parameter(
     *         name="password",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="123456",
     *      ),
     *      @SWG\Response(response=200, description="token"),
     *      @SWG\Response(response=401, description="Unauthorized"),
     *      @SWG\Response(response=422, description="Validation Error"),
     *      @SWG\Response(response=403, description="Forbidden The client did not have permission to access the requested resource."),
     * )
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $username = $request->username;
        $row = User::where(function ($q) use ($username){
            $q->where('username',$username)->orWhere('email',$username);
        })->first();
        if ($row)
        {
            if (Hash::check($request->password,$row->password))
            {
                $token =  auth()->login($row);
                return $this->respondWithToken($token);
            }
            return $this->responseJson('Email Or Password Is Invalid.',401);
        }
        return $this->responseJson('Error Your Credential is Wrong.',401);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"users auth (patient , doctor)"},
     *      path="/auth/users/reset-password",
     *      summary="reset password",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Parameter(
     *         name="email",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="rep1@gmail.com",
     *      ),
     *      @SWG\Response(response=200, description="token"),
     *      @SWG\Response(response=401, description="Unauthorized"),
     *      @SWG\Response(response=422, description="Validation Error"),
     *      @SWG\Response(response=403, description="Forbidden The client did not have permission to access the requested resource."),
     * )
     * @param ResetPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        try
        {
            if (!$user = User::where('email',$request->email)->first())
            {
                return $this->responseJson('No Account With This E-mail Try Again.',400);
            }
            $rand_token = md5(rand(000000,999999));
            $user->update(['reset_token'=>$rand_token]);
            Mail::to($request->email)->send(new ResetPasswordMail($rand_token));
            return $this->responseJson('Send Successfully. Check Your E-mail!',200);
        }catch (\Exception $exception)
        {
            return $this->responseJson($exception->getMessage(),400);
        }
        return $this->responseJson('Error Happen Try Again!',400);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"users auth (patient , doctor)"},
     *      path="/auth/users/logout",
     *      summary="logout currently logged in user",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="message"),
     *      @SWG\Response(response=401, description="Unauthorized"),
     *      @SWG\Response(response=422, description="Validation Error"),
     *      @SWG\Response(response=403, description="Forbidden The client did not have permission to access the requested resource."),
     * )
     */
    public function logout()
    {
        auth()->logout();
        return $this->responseJson('Successfully logged out',200);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"users auth (patient , doctor)"},
     *      path="/auth/users/refresh",
     *      summary="refreshes expired token",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="message"),
     *      @SWG\Response(response=401, description="Unauthorized"),
     *      @SWG\Response(response=422, description="Validation Error"),
     *      @SWG\Response(response=403, description="Forbidden The client did not have permission to access the requested resource."),
     * )
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'account' => AccountResource::make(auth('api')->user()),
        ]);
    }
}
