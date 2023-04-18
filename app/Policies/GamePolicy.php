<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GamePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('Show-Games') || $user->hasPermissionTo('*') || $user->hasPermissionTo('Manage-Games');
    }
    public function view(User $user)
    {
        return $user->hasPermissionTo('Show-Game') || $user->hasPermissionTo('*') || $user->hasPermissionTo('Manage-Games');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('Add-Game') || $user->hasPermissionTo('*') || $user->hasPermissionTo('Manage-Games');
    }

    public function update(User $user)
    {
        return $user->hasPermissionTo('Update-Game') || $user->hasPermissionTo('*') || $user->hasPermissionTo('Manage-Games');
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo('Delete-Game') || $user->hasPermissionTo('*') || $user->hasPermissionTo('Manage-Games');
    }
}
