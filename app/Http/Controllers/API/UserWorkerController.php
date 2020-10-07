<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\UserWorker;
use App\Models\Worker;
use Illuminate\Support\Facades\Validator;

class UserWorkerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userWorkers = UserWorker::all();

        return $this->sendResponse($userWorkers->toArray(), 'UserWorkers retrieved successfully.');
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

        $userWorker = UserWorker::create($input);

        return $this->sendResponse($userWorker->toArray(), 'UserWorker created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userWorker = UserWorker::find($id);

        if (is_null($userWorker)) {
            return $this->sendError('UserWorker not found.');
        }

        return $this->sendResponse($userWorker, 'UserWorker retrieved successfully');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserWorker $userWorker)
    {
        $input = $request->all();

        $this->validateRequestInput($input);

        $userWorker->user_id = $input['user_id'];
        $userWorker->worker_id = $input['worker_id'];
        $userWorker->save();

        return $this->sendResponse($userWorker->toArray(), 'UserWorker updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserWorker $userWorker)
    {
        $userWorker->delete();

        return $this->sendResponse($userWorker->toArray(), 'UserWorker deleted successfully');
    }


    /**
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
        $userWorkers = UserWorker::all();

        if (isset($input['query'])) {
            $query = $input['query'];
            $userWorkers = $userWorkers->where('name', '=', $query);
        }

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

        if (isset($input['page'])) {
            $page = $input['page'];
        }

        $result = $this->paginateData($userWorkers->toArray());

        return $this->sendResponse($result, 'UserWorkers retrieved successfully.');
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
            'github' => 'string',
            'worker_id' => 'required|int'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors(), 406);       
        }
    }
}
