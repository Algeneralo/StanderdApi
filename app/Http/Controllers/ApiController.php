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

    /**
     * @param int $status
     * @param string $message
     * @param array $data
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * this response is for fetch data that have result only
     *
     * @param $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($message, $data = [])
    {
        $array = [
            "status" => OK,
            "message" => $message,
            "data" => $data,
        ];
        return response()->json($array);
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function failedResponse($message)
    {
        $array = [
            "status" => FAILED,
            "message" => $message,
        ];
        return response()->json($array);
    }


    /**
     * this response is for (update,delete ,and fetch[only if there's no data])
     *
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function noContentResponse($message)
    {
        $array = [
            "status" => NO_CONTENT,
            "message" => $message,
        ];
        return response()->json($array);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function createResponse($data)
    {
        $array = [
            "status" => CREATED,
            "message" => "Created Successfully",
            "data" => $data,
        ];
        return response()->json($array);
    }

    /**
     * validation error in request data
     *
     * @param $validator
     * @return \Illuminate\Http\JsonResponse
     */
    public function validationErrorResponse($validator)
    {
        $array = [
            "status" => VALIDATION_ERROR,
            "message" => $validator->errors()->first(),
            "errors" => $validator->errors(),
        ];
        return response()->json($array);
    }

    /**
     * system error
     *
     * @param \Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
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
