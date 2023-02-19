<?php

use App\Http\Controllers\admin;
use App\Http\Controllers\authentication;
use App\Http\Controllers\baseFeature;
// use App\Http\Controllers\comment;
use App\Http\Controllers\feature;
use App\Http\Controllers\image;
use App\Http\Controllers\member;
use App\Http\Controllers\role;
use App\Http\Controllers\task;
use App\Http\Controllers\team;
use App\Http\Controllers\technical;
use Illuminate\Support\Facades\Route;




Route::group(["middleware"=>"api_password"],function(){


    Route::post("/login",[authentication::class,"login"]);
    Route::post("refreshtoken",[authentication::class,"refreshtoken"]);
    Route::group(["middleware"=>"auth:api"],function(){


        Route::post("/logoutadmin",[authentication::class,"logoutadmin"]);
        Route::get("/getalladmin",[admin::class,"getalladmin"])->middleware("can:admin");
        Route::post("/createadmin",[admin::class,"create"])->middleware("can:admin");
        Route::post("/updateadmin",[admin::class,"update"])->middleware("can:admin");
        Route::get("/getmyadmininfo",[admin::class,"getmyadmininfo"]);
        Route::post("/deleteadmin",[admin::class,"delete"])->middleware("can:admin");






        Route::post("/createrole",[role::class,"create"])->middleware("can:role");
        Route::post("/updaterole",[role::class,"update"])->middleware("can:role");
        Route::get("/getrole",[role::class,"getrole"])->middleware("can:role");
        Route::post("/deleterole",[role::class,"delete"])->middleware("can:role");
        Route::get("/getallrole",[role::class,"getallrole"])->middleware("can:role");



        Route::post("/createtechnical",[technical::class,"create"])->middleware("can:technical");
        Route::post("/updatetechnical",[technical::class,"update"])->middleware("can:technical");
        Route::get("/gettechnical",[technical::class,"gettechnical"])->middleware("can:technical");
        Route::post("/deletetechnical",[technical::class,"delete"])->middleware("can:technical");
        Route::get("/getalltechnical",[technical::class,"getalltechnical"])->middleware("can:technical");


        Route::post("/uploadimages",[image::class,"upload"]);
        Route::post("/uploadimage",[image::class,"uploadone"])->middleware("checkAllToken");



        Route::post("/createmember",[member::class,"store"])->middleware("can:member");
        Route::post("/updatemember",[member::class,"update"])->middleware("can:member");
        Route::get("/getuser",[member::class,"getuser"])->middleware("can:member");
        Route::get("getalluser",[member::class,"getalluser"])->middleware("can:member");
        Route::post("/deleteuser",[member::class,"delete"])->middleware("can:member");



        Route::post("/createteam",[team::class,"store"])->middleware("can:team");
        Route::post("/updateteam",[team::class,"update"])->middleware("can:team");
        Route::get("/getallteam",[team::class,"getallteam"])->middleware("can:team");
        Route::get("/getteam",[team::class,"getteam"])->middleware("can:team");
        Route::post("/deleteteam",[team::class,"delete"])->middleware("can:team");



        Route::post("/createbasefeature",[baseFeature::class,"store"])->middleware("can:feature");
        Route::post("/updatebasefeature",[baseFeature::class,"update"])->middleware("can:feature");
        Route::get("/getallbasefeature",[baseFeature::class,"getall"])->middleware("can:feature");
        Route::get("/getbasefeature",[baseFeature::class,"getOne"])->middleware("can:feature");
        Route::post("/deletebasefeature",[baseFeature::class,"delete"])->middleware("can:feature");


        Route::post("/createtask",[task::class,"store"])->middleware("can:task");
        Route::post("/updatetask",[task::class,"update"])->middleware("can:task");
        Route::post("task/updateteam",[task::class,"updateteam"])->middleware("can:task");
        Route::post("getalltask",[task::class,"getalltask"])->middleware("can:task");
        Route::post("deletetask",[task::class,"delete"])->middleware("can:task");
        Route::post("importtask",[task::class,"import"])->middleware("can:task");
        Route::post("admintaskdilter",[task::class,"admintaskdilter"])->middleware("can:task");



        Route::post("/addfeaturetotask",[feature::class,"store"])->middleware("can:feature");
        Route::post("/updatefeaturetask",[feature::class,"update"])->middleware("can:feature");
        Route::post("/deletefeaturetask",[feature::class,"delete"])->middleware("can:feature");
        Route::post("/importfeature",[feature::class,"import"])->middleware("can:feature");


        Route::post("/sendemail",[admin::class,"sendmail"])->middleware("sendmail");




    });


    Route::group(["middleware"=>"auth:user"],function(){

        Route::post("filtertaskuser",[task::class,"filtertaskuser"]);
        Route::post("/logout",[authentication::class,"logout"]);

    });


});