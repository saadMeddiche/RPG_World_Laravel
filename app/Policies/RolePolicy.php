<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('Show_Roles') ||  $user->hasPermissionTo('*');
    }

    public function assignRole(User $user)
    {
        return $user->hasPermissionTo('assignRole') ||  $user->hasPermissionTo('*');
    }

    public function RemoveRole(User $user)
    {
        return $user->hasPermissionTo('RemoveRole') ||  $user->hasPermissionTo('*');
    }
}
