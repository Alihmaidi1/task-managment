<?php 
namespace App\Services\repo\concrete;

use App\Models\temp;
use App\Models\User as ModelsUser;
use App\Services\repo\interfaces\imageInterface;
use App\Services\repo\interfaces\userInterface;
use Illuminate\Support\Facades\Hash;

class user implements userInterface{


    public $image;
    public function __construct(imageInterface $image){

        $this->image=$image;


    }


    public function getUserByEmail($email){


        return ModelsUser::where("email",$email)->firstOrFail();
    }

    public function store($name,$email,$password,$gender,$image_id,$date_of_birth){

        $image=$this->image->getTempFile($image_id);
        $this->image->MoveFile($image->getRawOriginal("url"),"temp","member");
        $image=$this->image->deleteTempFile($image->id);
        return  ModelsUser::create([

            "name"=>$name,
            "email"=>$email,
            "password"=>Hash::make($password),
            "date_of_birth"=>$date_of_birth,
            "url"=>$image->getRawOriginal("url"),
            "gender"=>$gender
            
        ]);



    }

    
}