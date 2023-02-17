<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\admin;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;

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

        $permissions=config("permission");
        foreach($permissions as $permission){

            Gate::define($permission,function(admin $admin)use($permission){


                $permissions=$admin->role->permissions;
                if(in_array($permission,$permissions)){

                return true;

                }

                throw new HttpResponseException(response()->json(["message"=>"you dont have permission to fo this action"],403));

            });


        }

        $this->registerPolicies();

        //
    }
}
