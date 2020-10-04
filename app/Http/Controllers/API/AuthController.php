<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\ConfirmRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SendRequest;
use App\Http\Requests\RestoreConfirmRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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
    public function restore(SendRequest $request)
    {
        $input = $request->only('email');
        $data = URL::action([self::class, 'restoreConfirm']);
        
        Mail::raw('Follow this link to restore:'. $data, function($message) use ($input) {
            $message->to($input['email'])->subject('Restore password');
            });
        
        return $this->sendResponse($data, 'Email was sent successfully.', 201);
    }


    /**
     * 
     * 
     * 
     */
    public function restoreConfirm(RestoreConfirmRequest $request)
    {
        $input = $request->only('password');
        $password = bcrypt($input['password']);
        $user = Auth::user();
        $user->password = $password;
        $user->save();
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
