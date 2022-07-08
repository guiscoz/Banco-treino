<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // $permissions = Permission::with('roles')->get();

        // foreach($permissions as $keyPermissions => $permission) {
        //     Gate::define($permission->name, function(User $user) use ($permission) {
        //         return $user->hasPermission($permission);
        //     });
        // }

        Gate::before(function (User $user) {
            if ($user->hasRole('Super Admin')){
                return true;
            }
        });

        Gate::after(function ($user, $ability) {
            return $user->hasRole('Super Admin'); // note this returns boolean
        });
    }
}
