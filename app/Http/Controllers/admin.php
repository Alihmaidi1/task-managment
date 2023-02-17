<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\create;
use App\Http\Requests\admin\getadmin;
use App\Http\Requests\admin\sendmail;
use App\Http\Requests\admin\update;
use App\Jobs\SendMails;
use App\Services\repo\interfaces\adminInterface;
use Illuminate\Http\Request;

class admin extends Controller
{

    public $admin;
    public function __construct(adminInterface $admin){

        $this->admin=$admin;

    }

    public function getalladmin(Request $request){
        try{


            return response()->json(["data"=>$this->admin->getAllAdmin()],200);

        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }



    }



    public function create(create $request){

        try{


            $name=$request->name;
            $email=$request->email;
            $password=$request->password;
            $role_id=$request->role_id;
            $admin=$this->admin->store($name,$email,$password,$role_id);
            $admin->role;
            return response()->json(["data"=>$admin],200);



        }catch(\Exception $ex){

            return response()->json(["message"=>$ex->getMessage()],500);

        }

    }



    public function update(update $request){

        try{

            $id=$request->id;
            $name=$request->name;
            $email=$request->email;
            $password=$request->password;
            $role_id=$request->role_id;
            $admin=$this->admin->update($id,$name,$email,$password,$role_id);
            $admin->role;
            return response()->json(["data"=>$admin],200);




        }catch(\Exception $ex){



            return response()->json(["message"=>$ex->getMessage()],500);



        }


    }


    public function getmyadmininfo(Request $request){



        try{

            return response()->json(["data"=>auth("api")->user()],200);


        }catch(\Exception $ex){



            return response()->json(["message"=>$ex->getMessage()],500);

        }

    }



    public function delete(getadmin $request){

        try{

            $id=$request->id;
            $admin=$this->admin->delete($id);
            $admin->role;
            return response()->json(["data"=>$admin],200);


        }catch(\Exception $ex){



            return response()->json(["message"=>$ex->getMessage()],500);


        }


    }


    public function sendmail(sendmail $request){

        try{

            $members=$request->members;
            $title=$request->title;
            $content=$request->content;
            $job=new SendMails($members,$title,$content);
            dispatch($job);
            return response()->json(["message"=>"the mail in Sending..."],200);


        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }



    }



}
