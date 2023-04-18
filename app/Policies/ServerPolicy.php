<?php

namespace App\Policies;

use App\Models\Server;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServerPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('Show-Servers') || $user->hasPermissionTo('*') || $user->hasPermissionTo('Manage-Servers');
    }

    public function view(User $user)
    {
        return $user->hasPermissionTo('Show-Server') || $user->hasPermissionTo('*') || $user->hasPermissionTo('Manage-Servers');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('Add-Server') || $user->hasPermissionTo('*') || $user->hasPermissionTo('Manage-Servers');
    }

    public function update(User $user)
    {
        return $user->hasPermissionTo('Update-Server') || $user->hasPermissionTo('*') || $user->hasPermissionTo('Manage-Servers');
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo('Delete-Server') || $user->hasPermissionTo('*') || $user->hasPermissionTo('Manage-Servers');
    }
}
