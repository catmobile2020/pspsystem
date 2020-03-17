<?php

namespace App\Http\Controllers\Api;

use App\CompanyUsers;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Resources\AccountResource;
use App\Mail\ResetPasswordMail;
use App\Pharmacy;
use App\PharmacyUsers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public $guard;
    public function __construct()
    {
//        $guard = explode('/',request()->route()->uri())[2];
        $guard = request()->guard;
//        if ($guard == 'userApi')
//        {
//            $guard ='api';
//        }
        $this->guard = $guard;
        $this->middleware('auth:'.$guard, ['except' => ['login','register','resetPassword']]);
        auth()->shouldUse($guard);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"auth"},
     *      path="/auth/{guard}/login",
     *      summary="login",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Parameter(
     *         name="guard",
     *         in="path",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="userApi",
     *         description="userApi , companyApi , pharmacyAdminApi , pharmacyUsersApi ",
     *      ),@SWG\Parameter(
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
        switch ($this->guard)
        {
            case 'companyApi':
                $model = 'App\CompanyUsers';
                break;
            case 'pharmacyAdminApi':
                $model = 'App\Pharmacy';
                break;
            case 'pharmacyUsersApi':
                $model = 'App\PharmacyUsers';
                break;
            default:
                $model = 'App\User';
        }
        $row = $model::where(function ($q) use ($username){
            $q->where('username',$username)->orWhere('email',$username);
        })->first();
        if ($row)
        {
            if (Hash::check($request->password,$row->password))
            {
                $token =  auth()->login($row);
                if ($token)
                {
                    return $this->respondWithToken($token);
                }
                return $this->responseJson('You Try To Login in Another privileges',401);
            }
            return $this->responseJson('Email Or Password Is Invalid.',401);
        }
        return $this->responseJson('Error Your Credential is Wrong.',401);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"auth"},
     *      path="/auth/{guard}/reset-password",
     *      summary="reset password",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Parameter(
     *         name="guard",
     *         in="path",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="userApi",
     *         description="userApi , companyApi , pharmacyAdminApi , pharmacyUsersApi ",
     *      ),
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
     *      tags={"auth"},
     *      path="/auth/{guard}/logout",
     *      summary="logout currently logged in user",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Parameter(
     *         name="guard",
     *         in="path",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="userApi",
     *         description="userApi , companyApi , pharmacyAdminApi , pharmacyUsersApi ",
     *      ),
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
     *      tags={"auth"},
     *      path="/auth/{guard}/refresh",
     *      summary="refreshes expired token",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Parameter(
     *         name="guard",
     *         in="path",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="userApi",
     *         description="userApi , companyApi , pharmacyAdminApi , pharmacyUsersApi ",
     *      ),
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
            'expires_in' => auth()->factory()->getTTL() * 60,
            'account' => AccountResource::make(auth()->user()),
        ]);
    }
}
