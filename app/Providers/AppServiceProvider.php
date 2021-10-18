<?php

namespace App\Providers;

use App\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Gate::define("is_admin", function (User $user) {
            foreach ($user->roles as $role) {
                if ($role->id === 1) {
                    return true;
                }
            }

            return false;
        });


        Gate::define("is_registration", function (User $user) {
            foreach ($user->roles as $role) {
                if (in_array($role->id, [1, 3])) {
                    return true;
                }
            }

            return false;
        });

        Gate::define("is_payment", function (User $user) {
            foreach ($user->roles as $role) {
                if (in_array($role->id, [1, 4])) {
                    return true;
                }
            }

            return false;
        });

        Gate::define("is_acomodation", function (User $user) {
            foreach ($user->roles as $role) {
                if (in_array($role->id, [1, 5])) {
                    return true;
                }
            }

            return false;
        });
    }
}
