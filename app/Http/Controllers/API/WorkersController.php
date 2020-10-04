<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Worker;
use Illuminate\Support\Facades\Validator;

class WorkersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = Worker::all();
        
        return response()->json($workers->toArray(), 200);
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

        $worker = Worker::create($input);

        return $this->sendResponse($worker->toArray(), 'Worker created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $worker = Worker::find($id);

        if (is_null($worker)) {
            return $this->sendError('Worker not found.');
        }

        return $this->sendResponse($worker->toArray(), 'Worker retrieved successfully');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {
        $input = $request->all();

        $this->validateRequestInput($input);

        $worker->adopted_at = $input['adopted_at'];
        $worker->department_id = $input['department_id'];
        $worker->position_id = $input['position_id'];
        $worker->save();

        return $this->sendResponse($worker->toArray(), 'Worker updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        $worker->delete();

        return $this->sendResponse($worker->toArray(), 'Worker deleted successfully');
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
            'adopted_at' => 'required|string',
            'department_id' => 'required|int',
            'position_id' => 'required|int'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors(), 406);       
        }
    }
}
