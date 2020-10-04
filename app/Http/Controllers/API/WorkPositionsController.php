<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\WorkPosition;
use Illuminate\Support\Facades\Validator;

class WorkPositionsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workPositions = WorkPosition::all();

        return $this->sendResponse($workPositions->toArray(), 'WorkPositions retrieved successfully.');
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

        $workPosition = WorkPosition::create($input);

        return $this->sendResponse($workPosition->toArray(), 'WorkPosition created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workPosition = WorkPosition::find($id);

        if (is_null($workPosition)) {
            return $this->sendError('WorkPosition not found.');
        }

        return $this->sendResponse($workPosition->toArray(), 'WorkPosition retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkPosition $workPosition)
    {
        $input = $request->all();

        $this->validateRequestInput($input);

        $workPosition->name = $input['name'];
        $workPosition->save();

        return $this->sendResponse($workPosition->toArray(), 'WorkPosition updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkPosition $workPosition)
    {
        $workPosition->delete();

        return $this->sendResponse($workPosition->toArray(), 'WorkPosition deleted successfully.');
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
            'name' => 'required|string'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors(), 406);       
        }
    }
}
