<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\Response;

class RespondWith
{
    public static function success($data = [], string $message = 'Successful', int $code = Response::HTTP_OK)
    {
        return response()->json(['status' => 'success', 'message' => $message, 'data' => $data], $code);
    }

    public static function error($data = [], string $message = 'An error occured', int $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json(['status' => 'error', 'message' => $message, 'data' => $data], $code);
    }
}
