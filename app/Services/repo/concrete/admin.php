<?php 

namespace App\Services\repo\concrete;

use App\Models\admin as ModelsAdmin;
use App\Services\repo\interfaces\adminInterface;

class admin implements adminInterface{


    public function getUserByEmail($email){


        return ModelsAdmin::where("email",$email)->firstOrFail();
    }


}