<?php

use App\Http\Controllers\authentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::group(["middleware"=>"api_password"],function(){


    Route::post("/login",[authentication::class,"login"]);
    Route::post("refreshtoken",[authentication::class,"refreshtoken"]);

    Route::group(["middleware"=>"auth:api"],function(){


        Route::post("/logoutadmin",[authentication::class,"logoutadmin"]);




    });


    Route::group(["middleware"=>"auth:user"],function(){

        // Route::post("/logout",[authentication::class,"logout"]);

    });


});