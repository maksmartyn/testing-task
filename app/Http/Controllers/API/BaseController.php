<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $code = 200)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }


    /**
     * Paginate data array.
     *
     * @param  array  $input
     * @param  int  $page
     * @param  int  $perPage
     * @return array
     */
    protected function paginateData($data, $page, $perPage = 10)
    {
        $offSet = ($page * $perPage) - $perPage;  
        $currentPageItems = array_slice($data, $offSet, $perPage, true);  
        $paginator = new LengthAwarePaginator(
            $currentPageItems, 
            count($data), 
            $perPage, 
            $page
        );
        $result = $paginator->toArray();

        return $result;
    }
}
