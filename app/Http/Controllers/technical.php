<?php

namespace App\Http\Controllers;

use App\Http\Requests\technical\create;
use App\Http\Requests\technical\gettechnical;
use App\Http\Requests\technical\update;
use App\Services\repo\interfaces\technicalInterface;
use Illuminate\Http\Request;

class technical extends Controller
{



    public $technical;
    public function __construct(technicalInterface $technical){

        $this->technical=$technical;

    }

    public function create(create $request){

        try{

            $name=$request->name;
            $technical=$this->technical->store($name);
            return response()->json(["data"=>$technical],200);


        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }



    public function update(update $request){

        try{

            $id=$request->id;
            $name=$request->name;
            $technical=$this->technical->update($id,$name);
            return response()->json(["data"=>$technical],200);


        }catch(\Exception $ex){



            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }



    public function gettechnical(gettechnical $request){

        try{

            $id=$request->id;
            $technical=$this->technical->getTechnical($id);
            return response()->json(["data"=>$technical],200);

        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }



    public function getalltechnical(Request $request){

        try{

            return response()->json(["data"=>$this->technical->getAllTechnical()],200);

        }catch(\Exception $ex){



            return response()->json(["message"=>$ex->getMessage()],500);

        }





    }




    public function delete(gettechnical $request){

        try{

            $id=$request->id;
            $technical=$this->technical->delete($id);
            return response()->json(["data"=>$technical],200);


        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()]);

        }


    }
}
