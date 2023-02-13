<?php 

namespace App\Services\repo\concrete;

use App\Models\role as ModelsRole;
use App\Services\repo\interfaces\roleInterface;


class role implements roleInterface{

    public function store($name,$permissions){


        return ModelsRole::create([

            "name"=>$name,
            "permissions"=>json_encode($permissions)

        ]);
    }


    public function update($id,$name,$permissions){


        $role=ModelsRole::FindOrFail($id);
        $role->name=$name;
        $role->permissions=json_encode($permissions);
        $role->save();
        return $role;
        
    }


    public function getRole($id){


        return ModelsRole::findOrFail($id);
    }

    public function delete($id){

        $role=ModelsRole::findOrFail($id);
        $role1=$role;
        $role->delete();
        return $role1;

        
    }

    public function getAllRole(){

        return ModelsRole::all();
    }


}