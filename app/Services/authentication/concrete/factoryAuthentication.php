<?php 


namespace App\Services\authentication\concrete;
use App\Services\authentication\interfaces\factoryAuthenticationInterface;
use App\Services\authentication\concrete\admin;
use App\Services\authentication\concrete\user;
use App\Services\repo\concrete\admin as adminRepo;
use App\Services\repo\concrete\user as userRepo;


class factoryAuthentication implements factoryAuthenticationInterface{


    public function create($type){

        return ($type==0)? new admin():new user();

    }

    public function getUser($type){

        return ($type==0)?new adminRepo():new userRepo();
    }




}

