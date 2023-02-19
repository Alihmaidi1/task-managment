<?php

namespace App\Http\Controllers;

use App\Events\messageEvent;
use App\Http\Requests\comment\admintaskcomment;
use App\Http\Requests\comment\featureadmincomment;
use App\Services\repo\interfaces\commentInterface;

class comment extends Controller
{

    public $comment;

    public function __construct(commentInterface $comment){

        $this->comment=$comment;

    }
    public function adminaddcommenttask(admintaskcomment $request){

        try{

            $comment=$this->comment->store($request->content,auth("api")->user()->id,"App\\Models\\admin",$request->id,"App\\Models\\task");
            event(new messageEvent($comment,"task",$request->id));
            return response()->json(["data"=>$comment],200);

        }catch(\Exception $ex){

            return response()->json(["message"=>$ex->getMessage()],500);

        }

    }


    public function admincommenttofeature(featureadmincomment $request){


        try{

            $comment=$this->comment->store($request->content,auth("api")->user()->id,"App\\Models\\admin",$request->id,"App\\Models\\feature");
            event(new messageEvent($comment,"feature",$request->id));
            return response()->json(["data"=>$comment],200);



        }catch(\Exception $ex){



            return response()->json(["message"=>$ex->getMessage()],500);


        }


    }


    public function usercommenttotask(admintaskcomment $request){

        try{



            $comment=$this->comment->store($request->content,auth("user")->user()->id,"App\\Models\\user",$request->id,"App\\Models\\task");
            event(new messageEvent($comment,"task",$request->id));
            return response()->json(["data"=>$comment],200);






        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);


        }


    }



    public function usercommenttofeature(featureadmincomment $request){

        try{

            $comment=$this->comment->store($request->content,auth("user")->user()->id,"App\\Models\\user",$request->id,"App\\Models\\feature");
            event(new messageEvent($comment,"feature",$request->id));
            return response()->json(["data"=>$comment],200);


        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);
        }


    }

}