<?php

namespace App\Providers;

use App\Services\authentication\concrete\factoryAuthentication;
use App\Services\authentication\interfacces\factoryAuthenticationInterface;
use App\Services\repo\concrete\admin;
use App\Services\repo\concrete\image1;
use App\Services\repo\concrete\member;
use App\Services\repo\concrete\role;
use App\Services\repo\concrete\team;
use App\Services\repo\concrete\technical;
use App\Services\repo\concrete\user;
use App\Services\repo\interfaces\adminInterface;
use App\Services\repo\interfaces\imageInterface;
use App\Services\repo\interfaces\memberInterface;
use App\Services\repo\interfaces\roleInterface;
use App\Services\repo\interfaces\teamInterface;
use App\Services\repo\interfaces\technicalInterface;
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
        $this->app->bind(roleInterface::class,role::class);
        $this->app->bind(technicalInterface::class,technical::class);
        $this->app->bind(imageInterface::class,image1::class);
        $this->app->bind(teamInterface::class,team::class);

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
