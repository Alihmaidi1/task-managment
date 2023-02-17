<?php 

namespace App\Services\repo\concrete;

use App\Models\admin as ModelsAdmin;
use App\Services\repo\interfaces\adminInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class admin implements adminInterface{


    public function getUserByEmail($email){


        return Cache::rememberForever("admin:".$email,function()use($email){

            return ModelsAdmin::where("email",$email)->firstOrFail();
        });
    }

    public function getAllAdmin(){


        return ModelsAdmin::where("id","!=",auth()->user()->id)->get();
    }
    public function store($name,$email,$password,$role_id){

        Cache::pull("admins");
        return ModelsAdmin::create([

            "name"=>$name,
            "email"=>$email,
            "password"=>Hash::make($password),
            "role_id"=>$role_id
            
        ]);


    }

    public function update($id,$name,$email,$password,$role_id){


        $admin=ModelsAdmin::findOrFail($id);
        if($password!=null){

            $admin->password=Hash::make($password);
        }
        $admin->name=$name;
        $admin->email=$email;
        $admin->role_id=$role_id;
        $admin->save();
        Cache::pull("admins");
        Cache::pull("admin:".$id);
        Cache::pull("admin:".$email);


        return $admin;
        

    }


    public function delete($id){

        $admin=ModelsAdmin::findOrFail($id);
        $admin1=$admin;
        $admin->delete();
        Cache::pull("admins");
        Cache::pull("admin:".$id);
        Cache::pull("admin:".$admin1->email);

        return $admin1;


    }

}