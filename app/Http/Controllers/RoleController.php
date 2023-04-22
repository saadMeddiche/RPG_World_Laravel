<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Laravel\Sanctum\PersonalAccessToken;

class RoleController extends Controller
{
    public function index()
    {
        //Policie
        // $this->authorize('viewAny', Role::class);

        $roles = Role::all();

        return response()->json(['roles' => $roles]);
    }

    public function assignRole(Request $request)
    {
        //Policie
        // $this->authorize('assignRole', Role::class);

        $user = User::where('id', $request->user_id)->first();
        if (!$user) return  response()->json(['errors' => 'User Not Found'], 401);

        $role = Role::find($request->role_id);
        if (!$role) return  response()->json(['errors' => 'Role Not Found'], 401);

        $user->assignRole($role);

        return response()->json(['message' => 'Role assigned successfuly'], 200);
    }

    public function RemoveRole(Request $request)
    {
        //Policie
        // $this->authorize('RemoveRole', Role::class);

        $user = User::find($request->user_id);
        if (!$user) return  response()->json(['errors' => 'User Not Found'], 401);

        $role = Role::find($request->role_id);
        if (!$role) return  response()->json(['errors' => 'Role Not Found'], 401);

        $user->removeRole($role);

        return response()->json(['message' => 'Role removed successfuly'], 200);
    }

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
