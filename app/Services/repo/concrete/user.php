<?php 
namespace App\Services\repo\concrete;

use App\Models\temp;
use App\Models\User as ModelsUser;
use App\Services\repo\interfaces\imageInterface;
use App\Services\repo\interfaces\userInterface;
use Illuminate\Support\Facades\Hash;

class user implements userInterface{




    

    public function getUserByEmail($email){


        return ModelsUser::where("email",$email)->firstOrFail();
    }

    public function store($name,$email,$password,$gender,$url,$date_of_birth){

        return  ModelsUser::create([

            "name"=>$name,
            "email"=>$email,
            "password"=>Hash::make($password),
            "date_of_birth"=>$date_of_birth,
            "url"=>$url,
            "gender"=>$gender
            
        ]);



    }

    public function update($id,$name,$email,$password,$gender,$url,$date_of_birth){

        $user=ModelsUser::findOrFail($id);
        $user->name=$name;
        $user->email=$email;
        if($password!=null){
            $user->password=Hash::make($password);
        }
        $user->name=$name;
        $user->gender=$gender;
        $user->date_of_birth=$date_of_birth;
        $user->url=($url=="")?$user->getRawOriginal("url"):$url;
        $user->save();
        return $user;





    }
    public function getUser($id){


        return ModelsUser::findOrFail($id);
    }


    public function getAllUser(){

        return ModelsUser::all();
    }


    public function delete($id){

        $user=ModelsUser::findOrFail($id);
        unlink(public_path("member/v1/".$user->getRawOriginal("url")));
        unlink(public_path("member/v2/".$user->getRawOriginal("url")));
        unlink(public_path("member/v3/".$user->getRawOriginal("url")));
        $user1=$user;
        $user->delete();
        return $user1;
    
    }

    
}