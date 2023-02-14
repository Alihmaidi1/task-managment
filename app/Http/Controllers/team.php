<?php

namespace App\Http\Controllers;

use App\Http\Requests\team\getteam;
use App\Http\Requests\team\store;
use App\Http\Requests\team\update;
use App\Services\repo\interfaces\teamInterface;
use Illuminate\Http\Request;

class team extends Controller
{

    public $team;

    public function __construct(teamInterface $team){

        $this->team=$team;

    }


    public function store(store $request){

        try{

            $name=$request->name;
            $members=$request->members;
            $team=$this->team->store($name,$members);
            return response()->json(["data"=>$team],200);


        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }



    public function update(update $request){

        try{

            $id=$request->id;
            $name=$request->name;
            $members=$request->members;
            $team=$this->team->update($id,$name,$members);
            return response()->json(["data"=>$team],200);



        }catch(\Exception $ex){

            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }



    public function getallteam(Request $request){

        try{


            return response()->json(["data"=>$this->team->getAllTeam()],200);


        }catch(\Exception $ex){

            return response()->json(["message"=>$ex->getMessage()],500);
        }


    }




    public function getteam(getteam $request){

        try{

            $id=$request->id;
            return response()->json(["data"=>$this->team->getTeam($id)],200);


        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);


        }



    }



    public function delete(getteam $request){

        try{
            $id=$request->id;
            $team=$this->team->getTeam($id);
            $this->team->delete($id);
            return response()->json(["data"=>$team],200);

        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);


        }



    }

}
