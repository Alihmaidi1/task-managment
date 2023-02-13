<?php

use App\Http\Controllers\admin;
use App\Http\Controllers\authentication;
use App\Http\Controllers\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::group(["middleware"=>"api_password"],function(){


    Route::post("/login",[authentication::class,"login"]);
    Route::post("refreshtoken",[authentication::class,"refreshtoken"]);

    Route::group(["middleware"=>"auth:api"],function(){


        Route::post("/logoutadmin",[authentication::class,"logoutadmin"]);
        Route::get("/getalladmin",[admin::class,"getalladmin"]);
        Route::post("/createadmin",[admin::class,"create"]);
        Route::post("/updateadmin",[admin::class,"update"]);
        Route::get("/getmyadmininfo",[admin::class,"getmyadmininfo"]);
        Route::post("/deleteadmin",[admin::class,"delete"]);

        




        Route::post("/createrole",[role::class,"create"]);
        Route::post("/updaterole",[role::class,"update"]);
        Route::get("/getrole",[role::class,"getrole"]);
        Route::post("/deleterole",[role::class,"delete"]);
        Route::get("/getallrole",[role::class,"getallrole"]);


    });


    Route::group(["middleware"=>"auth:user"],function(){

        // Route::post("/logout",[authentication::class,"logout"]);

    });


});