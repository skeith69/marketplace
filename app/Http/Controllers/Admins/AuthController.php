<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function admin()
    {
        return response()->json([
            'message' => 'Successfully retrieve resource',
            'admin' => auth('api')->user()
        ], 200);
    }
}
