<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class RoleController extends Controller
{
    public function verify_staff_access(Request $request)
    {
        $user = PersonalAccessToken::findToken($request->token)->tokenable;

        if ($user->hasPermissionTo('*') || $user->hasPermissionTo('accessDashboard')) {

            $responce = [
                'access' => true,
                'token'  => $request->token

            ];

            //Return the response as a JSON object with HTTP status code 200 (OK)
            return response()->json($responce, 200);
        } else {

            $responce = [
                'access' => false,
                'token'  => $request->token
            ];

            //Return the response as a JSON object with HTTP status code 200 (OK)
            return response()->json($responce, 200);
        }
    }
}
