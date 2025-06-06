<?php

namespace App\Classes;

class ApiResponseClass
{
    public static function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
        ];
        if (! empty($message)) {
            $response['message'] = $message;
        }

        return response()->json($response, $code);
    }

    public static function sendError($message, $code = 400)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }
}
