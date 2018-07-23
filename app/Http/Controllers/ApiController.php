<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * request has done successfully and maybe there's a data
 */
Const OK = 200;
/**
 * The request has been created successfully, and the response will be the created object
 */
Const CREATED = 201;
/**
 * The request has been accepted for processing, but the processing has not been completed
 */
Const FAILED = 202;
/**
 * Request finished successfully, but there's no data
 */
Const NO_CONTENT = 204;
Const UNAUTHORIZED = 403;
/**
 * There's an error in input validation
 */
Const VALIDATION_ERROR = 422;
Const INTERNAL_ERROR = 500;

class ApiController extends BaseController
{

    public function generalResponse($status = OK, $message = '', $data = [], $errors = [])
    {
        $array = [
            "status" => $status,
            "message" => $message,
            "data" => $data,
            "errors" => $errors,
        ];
        return response()->json($array);
    }

    public function successResponse($message, $data = [])
    {
        $array = [
            "status" => OK,
            "message" => $message,
            "data" => $data,
        ];
        return response()->json($array);
    }

    public function failedResponse($message)
    {
        $array = [
            "status" => FAILED,
            "message" => $message,
        ];
        return response()->json($array);
    }

    public function noContentResponses($message = null)
    {
        $array = [
            "status" => NO_CONTENT,
            "message" => $message,
        ];
        return response()->json($array);
    }

    public function createResponse($data)
    {
        $array = [
            "status" => CREATED,
            "message" => "Created Successfully",
            "data" => $data,
        ];
        return response()->json($array);
    }

    public function validationErrorResponse($validator)
    {
        $array = [
            "status" => VALIDATION_ERROR,
            "message" => $validator->errors()->first(),
            "errors" => $validator->errors(),
        ];
        return response()->json($array);
    }

    public function internalErrorResponse(\Exception $exception)
    {
        $array = [
            "status" => INTERNAL_ERROR,
            "message" => "Internal Server Error",
            "errors" => [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
                'file' => $exception->getFile()
            ],
        ];
        return response()->json($array);
    }

}
