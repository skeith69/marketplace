<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Retrieve admin details.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdmin()
    {
        return response()->json([
            'message' => 'Successfully retrieve resource',
            'admin'   => auth('api')->user()
        ], 200);
    }
}
