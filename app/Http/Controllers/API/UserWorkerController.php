<?php 

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\UserWorker;
use App\Models\Worker;

class UserWorkerController extends BaseController
{    
    /**
     * @OA\Get(
     *     path="/workers/{user}",
     *     summary="Get worker info",
     *     tags={"Workers"},
     *     security={
     *         {"passport": {}},
     *     },
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="User id",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="login",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="name",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="image",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="about",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="github",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="worker",
     *                 @OA\Property(
     *                     property="department",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="position",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="adopted_at",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Not found",
     *     ),
     * )
     *
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

        $user = $user->only(
            'id',
            'login', 
            'name', 
            'email', 
            'image', 
            'about',
            'type',
            'github'
        );
        $worker = UserWorker::where('user_id', '=', $id)->first();

        if (is_null($worker)) {
            return $this->sendError('User is not worker.');
        }

        $worker = $worker->worker->first();
        $department = implode($worker->department->pluck('name')->toArray());
        $position =  implode($worker->position->pluck('name')->toArray());
        $worker = $worker->only('adopted_at');
        $worker['department'] = $department;
        $worker['position'] = $position;
        $userWorker = $user;
        $userWorker['worker'] = $worker;

        return $this->sendResponse($userWorker, 'UserWorker retrieved successfully');
    }


    /**
     * @OA\Get(
     *     path="/workers",
     *     summary="Get paginated workers list",
     *     tags={"Workers"},
     *     security={
     *         {"passport": {}},
     *     },
     *     @OA\Parameter(
     *         name="query",
     *         in="path",
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="Find by user name",
     *         required=false
     *     ),
     *     @OA\Parameter(
     *         name="department_id",
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Find by department id",
     *         required=false
     *     ),
     *     @OA\Parameter(
     *         name="position_id",
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Find by position id",
     *         required=false
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                  property="current_page",
     *                  type="integer"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(
     *                          property="login",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="image",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="about",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="github",
     *                          type="string"
     *                      )
     *                  )
     *              ),
     *              @OA\Property(
     *                  property="first_page_url",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="from",
     *                  type="integer",
     *              ),
     *              @OA\Property(
     *                  property="last_page",
     *                  type="integer",
     *              ),
     *              @OA\Property(
     *                  property="last_page_url",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="next_page_url",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="path",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="per_page",
     *                  type="integer",
     *              ),
     *              @OA\Property(
     *                  property="prev_page_url",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="to",
     *                  type="integer",
     *              ),
     *              @OA\Property(
     *                  property="total",
     *                  type="integer",
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Not Found",
     *     )
     * )
     *
     * Display a paginated listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request  $request)
    {
        $input = $request->all();
        unset($query);
        unset($workerId);
        $page = 1;
        $userWorkers = UserWorker::all();

        if (isset($input['department_id'])) {
            $workerId = Worker::where('department_id', '=', $input['department_id'])
                ->pluck('id')
                ->toArray();
            $userWorkers = $userWorkers->whereIn('worker_id', $workerId);
        }

        if (isset($input['position_id'])) {
            $workerId = Worker::where('position_id', '=', $input['position_id'])
                ->pluck('id')
                ->toArray();
            $userWorkers = $userWorkers->whereIn('worker_id', $workerId);
        }

        $userId = $userWorkers->pluck('user_id');
        $workers = collect();
        
        foreach($userId as $id) {
            $workers->push(User::find($id)->only(
                'login', 
                'name', 
                'email', 
                'image', 
                'about', 
                'github'
            ));
        }

        if (isset($input['query'])) {
                $query = $input['query'];
                $workers = $workers->where('name', '=', $query);
        }

        if (isset($input['page'])) {
            $page = $input['page'];
        }

        $result = $this->paginateData($workers->toArray(), $page);

        return $this->sendResponse($result, 'UserWorkers retrieved successfully.');
    }
}
