<?php

namespace App\Http\Controllers;

use App\Http\Requests\baseFeature\getbasefeature;
use App\Services\repo\interfaces\baseFeatureInterface;
use Illuminate\Http\Request;
use App\Http\Requests\baseFeature\store;
use App\Http\Requests\baseFeature\update;

class baseFeature extends Controller
{

    public $baseFeature;

    public function __construct(baseFeatureInterface $baseFeature){


        $this->baseFeature=$baseFeature;


    }



    public function store(store $request){

        try{

            $name=$request->name;
            $baseFeature=$this->baseFeature->store($name);
            return response()->json(["data"=>$baseFeature],200);


        }catch(\Exception $ex){

            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }



    public function update(update $request){

        try{

            $id=$request->id;
            $name=$request->name;
            $feature=$this->baseFeature->update($id,$name);

            return response()->json(["data"=>$feature],200);



        }catch(\Exception $ex){

            return response()->json(["message"=>$ex->getMessage()],500);
        }



    }


    public function getall(Request $request){


        try{


            return response()->json(["data"=>$this->baseFeature->getAll()],200);

        }catch(\Exception $ex){

            return response()->json(["message"=>$ex->getMessage()],500);
        }
    }



    public function getOne(getbasefeature $request){

        try{

            $feature=$this->baseFeature->getOne($request->id);
            return response()->json(["data"=>$feature],200);



        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }

    }



    public function delete(getbasefeature $request){
        try{

            $id=$request->id;
            $feature=$this->baseFeature->getOne($id);
            $this->baseFeature->delete($id);
            return response()->json(["data"=>$feature],200);            
            
        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }
}
