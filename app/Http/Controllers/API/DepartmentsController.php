<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Department;
use App\Models\WorkPosition;
use App\Models\UserWorker;
use App\Models\Worker;
use Auth;

class DepartmentsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $userWorker = UserWorker::where('user_id', '=', $userId)->first();
        $departments = Department::all();
        
        if (!is_null($userWorker)) {
            $worker = $userWorker->worker->first();
            $departments = $worker->department()->get();
        }
        
        $departments = $departments->map(function ($department) {
            $departmentId = $department->id;
            $positionId = Worker::where('department_id', '=', $departmentId)
                ->pluck('position_id')
                ->toArray();
            $positions = WorkPosition::whereIn('id', $positionId)->get()->toArray();
            $department->worker = $positions;
            
            return $department;
        });
        
        return $this->sendResponse($departments->toArray(), 'Departments retrieved successfully.');
    }
}
