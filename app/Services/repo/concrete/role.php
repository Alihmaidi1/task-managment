<?php 

namespace App\Services\repo\concrete;

use App\Models\role as ModelsRole;
use App\Services\repo\interfaces\roleInterface;
use Illuminate\Support\Facades\Cache;

class role implements roleInterface{

    public function store($name,$permissions){


        $role=ModelsRole::create([

            "name"=>$name,
            "permissions"=>json_encode($permissions)

        ]);
        Cache::pull("roles");
        return $role;
    }


    public function update($id,$name,$permissions){


        $role=ModelsRole::FindOrFail($id);
        $role->name=$name;
        $role->permissions=json_encode($permissions);
        $role->save();
        Cache::pull("roles");
        Cache::pull("role:".$id);
        return $role;
        
    }


    public function getRole($id){


        return Cache::rememberForever("role:".$id,function()use($id){

            return ModelsRole::findOrFail($id);
        });
    }

    public function delete($id){

        $role=ModelsRole::findOrFail($id);
        $role1=$role;
        $role->delete();
        Cache::pull("roles");
        Cache::pull("role:".$id);

        return $role1;
        
    }

    public function getAllRole(){

        return Cache::rememberForever("roles",function(){

            return ModelsRole::all();
        });
    }


}