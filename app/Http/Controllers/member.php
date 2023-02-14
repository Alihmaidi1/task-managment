<?php

namespace App\Http\Controllers;

use App\Http\Requests\member\store;
use App\Services\repo\interfaces\memberInterface;
use App\Services\repo\interfaces\userInterface;
use Illuminate\Http\Request;

class member extends Controller
{

    public $member;

    public function __construct(userInterface $member){

        $this->member=$member;

    }


    public function store(store $request){

        try{

            $name=$request->name;
            $email=$request->email;
            $password=$request->password;
            $gender=$request->gender;
            $image_id=$request->image_id;
            $date_of_birth=$request->date_of_birth;
            $user=$this->member->store($name,$email,$password,$gender,$image_id,$date_of_birth);

            return response()->json(["data"=>$user],200);


        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }

        
    }



}
