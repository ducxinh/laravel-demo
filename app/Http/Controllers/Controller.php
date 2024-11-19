<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


abstract class Controller
{
    /**
     * Response structure json success.
     *
     * @param  array  $data  Data return
     * @param  int  $statusCode  Status code
     * @return Response response data json
     */
    public function responseSuccess($data = [], $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json($data, $statusCode);
    }
}
