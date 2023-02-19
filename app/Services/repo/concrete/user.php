<?php
namespace App\Services\repo\concrete;

use App\Models\temp;
use App\Models\User as ModelsUser;
use App\Services\repo\interfaces\imageInterface;
use App\Services\repo\interfaces\userInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class user implements userInterface{






    public function getUserByEmail($email){


        return Cache::rememberForever("member:".$email,function()use($email){

            return ModelsUser::with(["tasks"])->where("email",$email)->firstOrFail();
        });
    }

    public function store($name,$email,$password,$gender,$url,$date_of_birth,$user_id){

        $user=ModelsUser::create([

            "name"=>$name,
            "email"=>$email,
            "password"=>Hash::make($password),
            "date_of_birth"=>$date_of_birth,
            "url"=>$url,
            "gender"=>$gender,
            "user_id"=>$user_id

        ]);
        Cache::pull("users");
        return $user;



    }

    public function update($id,$name,$email,$password,$gender,$url,$date_of_birth,$user_id){

        $user=ModelsUser::findOrFail($id);
        $user->name=$name;
        $user->email=$email;
        if($password!=null){
            $user->password=Hash::make($password);
        }
        $user->name=$name;
        $user->gender=$gender;
        $user->user_id=$user_id;
        $user->date_of_birth=$date_of_birth;
        $user->url=($url=="")?$user->getRawOriginal("url"):$url;
        $user->save();
        Cache::pull("users");
        Cache::pull("user:".$id);
        Cache::pull("user:".$email);

        return $user;





    }
    public function getUser($id){


        return Cache::rememberForever("user:".$id,function() use ($id){

            return ModelsUser::with(["tasks"])->where("id",$id)->firstOrFail();
        });
    }


    public function getAllUser(){

        return Cache::rememberForever("users",function(){

            return ModelsUser::with(["tasks"])->get();

        });
    }


    public function delete($id){

        $user=ModelsUser::findOrFail($id);
        Cache::pull("user:".$user->email);
        unlink(public_path("member/v1/".$user->getRawOriginal("url")));
        unlink(public_path("member/v2/".$user->getRawOriginal("url")));
        unlink(public_path("member/v3/".$user->getRawOriginal("url")));
        $user1=$user;
        $user->delete();
        Cache::pull("user:".$id);
        Cache::pull("users");
        return $user1;

    }


}