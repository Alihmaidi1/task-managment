<?php 
namespace App\Services\repo\concrete;

use App\Models\User as ModelsUser;
use App\Services\repo\interfaces\userInterface;

class user implements userInterface{



    public function getUserByEmail($email){


        return ModelsUser::where("email",$email)->firstOrFail();
    }

    
}