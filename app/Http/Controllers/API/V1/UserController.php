<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Sanctum\PersonalAccessToken;


class UserController extends Controller
{

    //Returns a JSON response containing the count of users
    public function count()
    {
        //Get the count of users
        $count_of_users = User::count();

        //Construct a response object containing the count of users
        $response = [
            'success' => true,
            'count' => $count_of_users
        ];

        //Return the response as a JSON object with HTTP status code 200 (OK)
        return response()->json($response, 200);
    }

    public function user_information(Request $request)
    {

        $user = PersonalAccessToken::findToken($request->token)->tokenable;

        //Construct a response object containing the informations of users
        $response = [
            'success' => true,
            'user' => $user
        ];

        //Return the response as a JSON object with HTTP status code 200 (OK)
        return response()->json($response, 200);
    }
}
