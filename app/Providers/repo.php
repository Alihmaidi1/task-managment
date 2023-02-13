<?php

namespace App\Providers;

use App\Services\authentication\concrete\factoryAuthentication;
use App\Services\authentication\interfacces\factoryAuthenticationInterface;
use App\Services\repo\concrete\admin;
use App\Services\repo\concrete\user;
use App\Services\repo\interfaces\adminInterface;
use App\Services\repo\interfaces\userInterface;
use Illuminate\Support\ServiceProvider;

class repo extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(adminInterface::class,admin::class);
        $this->app->bind(userInterface::class,user::class);
        // $this->app->bind(factoryAuthenticationInterface::class,factoryAuthentication::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
