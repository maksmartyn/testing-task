<?php 

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/user",
     *     summary="Get user info",
     *     tags={"User"},
     *     security={
     *         {"passport": {}},
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/User"
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized",
     *     )
     * )
     *
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user()->only(
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

        return $this->sendResponse($user, 'User retrieved successfully');
    }


    /**
     * @OA\Post(
     *     path="/user",
     *     summary="Update user info",
     *     tags={"User"},
     *     security={
     *         {"passport": {}},
     *     },
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             ref="#/components/schemas/UpdateUserRequest"
     *         ),
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/UpdateUserRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/User"
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized",
     *     )
     * )
     *
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateUserRequest  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();
        $input = $request->all();

        $user->name = $input['name'];
        $user->image = $input['image'];
        $user->about = $input['about'];
        $user->github = $input['github'];
        $user->city = $input['city'];
        $user->is_finished = $input['is_finished'];
        $user->phone = $input['phone'];
        $user->birthday = $input['birthday'];
        $user->save();

        return $this->sendResponse($user->toArray(), 'User updated successfully');
    }
}
