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
