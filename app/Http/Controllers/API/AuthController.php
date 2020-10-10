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
     * @param \App\Http\Requests\LoginRequest
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken(config('app.name'));
            $success['token'] = $token->accessToken;
            $success['user'] = $user->only(
                'id', 
                'login', 
                'name', 
                'email', 
                'image', 
                'about', 
                'type', 
                'github', 
                'city', 
                'is_finished', 
                'phone', 
                'birhtday'
            );
            return $this->sendResponse($success, 'User is logged in.');
        }

        return $this->sendError('Unauthorized', 'You cannot sign with those credentials', 401);
    }

    
    /**
     * Register new User
     *
     * @param \App\Http\Requests\RegisterRequest
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
        $success['user'] = $user->only(
            'id', 
            'login', 
            'name', 
            'email', 
            'image', 
            'about', 
            'type', 
            'github', 
            'city', 
            'is_finished', 
            'phone', 
            'birhtday'
        );

        return $this->sendResponse($success, 'User register successfully.');
    }


    /**
     * Restore password
     * 
     * @param \App\Http\Requests\SendRequest
     * @return \Illuminate\Http\Response
     */
    public function restore(SendRequest $request)
    {
        $input = $request->only('email');
        $user = User::where('email', '=', $input['email'])->first();

        if(is_null($user)) {
            return $this->sendError('Not found', 'User with this email does not exist.');
        }

        $token = $user->createToken(config('app.name'))->accessToken;
        $link = URL::action([self::class, 'restoreConfirm']);
        $emailBody = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
              <title>Password restore</title>
              <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            </head>
            <body style="margin: 0; padding: 0;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td>
                    <form id="restore" action="' . $link . '" method="post">
                      <input type="hidden" id="token" name="token" value="' . $token . '">
                      <div style="margin-bottom:10px">
                        <label for="password">New password</label><br>
                        <input required type="password" id="password" name="password" value="">
                      </div>
                      <div style="margin-bottom:10px">
                        <label for="password_confirmation">Confirm new password</label><br>
                        <input required type="password" id="password_confirmation" name="password_confirmation" value="">
                      </div>
                      <div>
                        <button type="submit" name="Submit">Submit</button>
                      </div>
                    </form>
                  </td>
                </tr>
              </table>
            </body>
          </html>';

        Mail::raw($emailBody, function($message) use ($input) {
            $message->to($input['email'])->subject('Restore password');
            });
        
        return $this->sendResponse(null, 'Email was sent successfully.', 201);
    }


    /**
     * Confirm password restore
     * 
     * @param \App\Http\Requests\RestoreConfirmRequest
     * @return \Illuminate\Http\Response
     */
    public function restoreConfirm(RestoreConfirmRequest $request)
    {
        $input = $request->only('password');
        $password = bcrypt($input['password']);
        $user = Auth::user();
        $user->password = $password;
        $user->save();

        return $this->sendResponse(null, 'Password was successfully changed.', 201);
    }


    /**
     * Confirm what??
     * 
     * @param \App\Http\Requests\ConfirmRequest
     * @return \Illuminate\Http\Response
     */
    public function confirm(ConfirmRequest $request)
    {
        //whats logic must be here??
    }
}
