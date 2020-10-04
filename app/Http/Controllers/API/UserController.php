<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $this->sendResponse($users->toArray(), 'Users retrieved successfully.');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $this->validateRequestInput($input);

        $user = User::create($input);

        return $this->sendResponse($user->toArray(), 'User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('User not found.');
        }

        return $this->sendResponse($user, 'User retrieved successfully');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();

        $this->validateRequestInput($input);

        $user->login = $input['login'];
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->image = $input['image'];
        $user->about = $input['about'];
        $user->type = $input['type'];
        $user->github = $input['github'];
        $user->save();

        return $this->sendResponse($user->toArray(), 'User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $this->sendResponse($user->toArray(), 'User deleted successfully');
    }


    /**
     * Validate request params.
     *
     * @param  array  $input
     * @return \Illuminate\Http\Response
     */
    private function validateRequestInput($input)
    {
        $validator = Validator::make($input, [
            'login' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string',
            'image' => 'string',
            'about' => 'string',
            'type' => 'required|string',
            'github' => 'string'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors(), 406);       
        }
    }
}
