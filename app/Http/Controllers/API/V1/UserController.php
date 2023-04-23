<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Spatie\Permission\Contracts\Permission;
use App\Http\Requests\AccountValidationForm;

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

    public function Users(Request $request)
    {
        $user = PersonalAccessToken::findToken($request->token)->tokenable;

        $users = User::whereNotIn('id', [$user->id])
            ->with('roles:id,name')
            ->get();

        $response = [
            'success' => true,
            'users' => $users
        ];

        return response()->json($response, 200);
    }

    public function update_user_informations(AccountValidationForm $request)
    {

        $data = $request->validated();

        $user = PersonalAccessToken::findToken($request->token)->tokenable;

        // Check if a user with the same email already exists, and return an error if it does
        if (User::where('email', $request->email)->first() && $request->email != $user->email) {
            $responce = [
                'success' => false,
                'errors' => [['This email is already taken']]
            ];

            //Return the error as a JSON object with HTTP status code 401 (Unauthorized )
            return response()->json($responce, 401);
        }

        // Check if a user with the same name already exists, and return an error if it does
        if (User::where('name', $request->name)->first() && $request->name != $user->name) {
            $responce = [
                'success' => false,
                'errors' => [['This name is already taken']]
            ];

            //Return the error as a JSON object with HTTP status code 401 (Unauthorized )
            return response()->json($responce, 401);
        }


        if (!check_current_password($user->password, $request->current_password)) {

            $response = [
                'errors' => [['Invalid Password']]
            ];

            return response()->json($response, 401);
        }

        if (!check_new_password($request->new_password, $request->repeat_password)) {

            $response = [
                'errors' => [['Please Repeat The Same Password']]
            ];

            return response()->json($response, 401);
        }

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (isset($data["new_password"])) {

            $user->password = Hash::make($data['new_password']);
        }

        $user->update();

        $response = [
            'success' => true,
        ];

        return response()->json($response, 200);
    }

    public function test(Request $request)
    {
        $user = User::find($request->user_id);

        $permissions = $user->getPermissionsViaRoles();

        $response = [
            'success' => true,
            'user' => $permissions
        ];

        return response()->json($response, 200);
    }
}
