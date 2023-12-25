<?php

namespace App\Base\Responses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait  apiResponse
{

    public function successfully($msg, $data, $status = JsonResponse::HTTP_OK)
    {
        return response()->json([
            'result' => true,
            'message' => $msg,
            'status' =>  $status,
            'data' => $data
        ],$status);
    }

    public function failed($msg , $status = JsonResponse::HTTP_NOT_FOUND)
    {
        return response()->json([
            'result' => false,
            'message' => $msg,
            'status' => $status,
//            'errors' => [
//                $errors
//            ]
        ], $status);
    }

}
