<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\ConfirmRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RestoreRequest;
use App\Http\Requests\RestoreConfirmRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    /**
     * Login User
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken(config('app.name'));
            $success['token_type'] = 'Bearer';
            $success['token'] = $token->accessToken;
            return $this->sendResponse($success, 'User is logged in.');
        }

        return $this->sendError('Unauthorized', 'You cannot sign with those credentials', 401);
    }

    
    /**
     * Register new User
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        
        $input = $request->only(
            'name',
            'email',
            'type',
            'github',
            'city',
            'phone',
            'birthday');
        $input['password'] = bcrypt($request['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken(config('app.name'))->accessToken;
        $success['user'] = $user->toArray();

        return $this->sendResponse($success, 'User register successfully.');
    }


    /**
     * 
     * 
     * 
     */
    public function restore(RestoreRequest $request)
    {
        //
    }


    /**
     * 
     * 
     * 
     */
    public function restoreConfirm(RestoreConfirmRequest $request)
    {
        //
    }


    /**
     * 
     * 
     * 
     */
    public function confirm(ConfirmRequest $request)
    {
        //
    }
}
