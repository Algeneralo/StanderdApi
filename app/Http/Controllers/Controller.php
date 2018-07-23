<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

    public function apiResponse($status = 200, $message = '', $data = [], $errors = [])
    {
        $array = [
            "status" => $status,
            "message" => $message,
            "data" => $data,
            "errors" => $errors,
        ];
        return response()->json($array);
    }
    
}
