<?php

namespace App\Providers;

use App\Policies\GamePolicy;
use App\Policies\RolePolicy;
use App\Policies\ServerPolicy;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Game' => 'App\Policies\GamePolicy',
        Role::class => RolePolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::resource('games', GamePolicy::class);
        // Gate::resource('servers', ServerPolicy::class);

    }
}
