<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

    public function boot(): void
    {
        Gate::define('admin', function($user) {
            foreach($user->roles as $role){
                if($role->name=='admin') {
                    return true;
                }   
            }
            return false;
        });

        if(env('FORCE_HTTPS',false)) {
            URL::forceScheme('https');
        }
    }
}
