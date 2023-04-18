<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginFormValidation;
use App\Http\Requests\RegisterFormValidation;
use GrahamCampbell\ResultType\Success;
use Spatie\Permission\Models\Role;


class AuthController extends Controller
{
    public function login(LoginFormValidation $request)
    {
        $data = $request->validated();


        $user = User::where('email', $data['email'])->first();


        if ($user && Hash::check($data['password'], $user->password)) {

            $token = $user->createToken('ProjectToken');

            $response = [
                'success' => true,
                'user' => $user,
                'token' => $token->plainTextToken,
            ];

            return response()->json($response, 200);
        } else {

            $response = [
                'success' => false,
                'errors' => [['Invalid Password']]
            ];

            return response()->json($response, 401);
        }
    }

    public function register(RegisterFormValidation $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);


        $user->assignRole('Member');

        $token = $user->createToken('ProjectToken');

        $response = [
            'success' => true,
            'user' => $user,
            'token' => $token->plainTextToken
        ];

        return response()->json($response, 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        $response = [
            'success' => true,
            'errors' => 'Logged Out Successfully'
        ];

        return response()->json($response, 200);
    }
}
