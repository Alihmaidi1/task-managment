<?php

namespace App\Http\Controllers;

use App\Http\Requests\member\getuser;
use App\Http\Requests\member\store;
use App\Http\Requests\member\update;
use App\Providers\repo;
use App\Services\fileOperation\intervenationImage;
use App\Services\repo\interfaces\imageInterface;
use App\Services\repo\interfaces\userInterface;
use Illuminate\Http\Request;

class member extends Controller
{

    public $member;

    public $image;
    public $temp;

    public function __construct(userInterface $member,imageInterface $image){

        $this->member=$member;
        $this->image=new intervenationImage($image);
        $this->temp=$image;

    }


    public function store(store $request){

        try{

            $name=$request->name;
            $email=$request->email;
            $password=$request->password;
            $gender=$request->gender;
            $image_id=$request->image_id;
            $date_of_birth=$request->date_of_birth;
            $image=$this->temp->getTempFile($image_id);
            $this->image->MoveFile($image->getRawOriginal("url"),"temp","member");
            $image=$this->temp->deleteTempFile($image->id);
            $user=$this->member->store($name,$email,$password,$gender,$image->getRawOriginal("url"),$date_of_birth);
            return response()->json(["data"=>$user],200);


        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }

        
    }



    public function update(update $request){

        try{
            $url="";
            $id=$request->id;
            $name=$request->name;
            $email=$request->email;
            $password=$request->password;
            $date_of_birth=$request->date_of_birth;
            $image_id=$request->image_id;
            $gender=$request->gender;
            if($image_id!=null){            
            $image=$this->temp->getTempFile($image_id);
            $this->image->MoveFile($image->getRawOriginal("url"),"temp","member");
            $url=$this->temp->deleteTempFile($image->id)->getRawOriginal("url");                                        
            }
            $user=$this->member->update($id,$name,$email,$password,$gender,$url,$date_of_birth);
            return response()->json(["data"=>$user],200);
        }catch(\Exception $ex){

            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }


    public function getuser(getuser $request){

        try{


            $user=$this->member->getUser($request->id);

            return response()->json(["data"=>$user],200);




        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }



    }


    public function getalluser(){

        try{


            $users=$this->member->getAllUser();
            return response()->json(["data"=>$users],200);



        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }



    public function delete(getuser $request){

        try{

            $user=$this->member->delete($request->id);
            return response()->json(["data"=>$user],200);

        }catch(\Exception $ex){

            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }

}
