<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function response($data)
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }
    public function success(string $message = null, $data = null)
    {
        return response()->json([
            'status' => 'success',
            'success' => true,
            'message' => $message ?? 'operation success',
            'data' => $data
        ], 200);
    }
    public function error(string $message, array $data = null)
    {
        return response()->json([
            'status' => 'error',
            'success' => false,
            'message' => $message ?? 'error occurred',
            'data' => $data
        ], 400);
    }
}
