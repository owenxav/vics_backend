<?php

namespace App\Helpers\V1;

class ApiResponse
{
    public static function success($data, $message = 'Operation successful', $statusCode=200)
    {
        $res = [];
        if(isset($data['pagination'])){
            $res['pagination'] = $data['pagination'];
        }
        if(isset($data['data'])){
            $res['data'] = $data['data'];
        }
        return response()->json(array_merge([
            'status' => true,
            'message' => $message,
            'data' => $data ?? [],
        ], $res), $statusCode);
    }

    // public static function successAuth($data, $message = 'Operation successful', $statusCode=200)
    // {
    //     return response()->json([
    //         'status' => true,
    //         'message' => $message,
    //         'data' => [
    //             "accessToken" => $data["accessToken"],
    //             "user" => $data
    //         ],
    //     ], $statusCode);
    // }

    public static function error($message = 'Operation failed', $statusCode=404, $data = null)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'error' => [
                'message' => $message,
            ],
            'data' => $data,
        ], $statusCode);
    }

    public static function validationError($errors, $message = 'Validation failed', $status = false)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
        ]);
    }
}
