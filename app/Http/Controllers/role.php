<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\role\create as createRequest;
use App\Http\Requests\role\update;
use App\Services\repo\interfaces\roleInterface;
use App\Http\Requests\role\get as getRequest;

class role extends Controller
{


    public $role;
    public function __construct(roleInterface $role){

        $this->role=$role;

    }

    public function create(createRequest $request){

        try{

            $name=$request->name;
            $permissions=$request->permissions;
            $role=$this->role->store($name,$permissions);
                        
            return response()->json(["data"=>$role],200);




        }catch(\Exception $ex){

            return response()->json($ex->getMessage(),500);

        }



    }



    public function update(update $request){


        try{


            $id=$request->id;
            $name=$request->name;
            $permissions=$request->permissions;
            $role=$this->role->update($id,$name,$permissions);
            return response()->json(["data"=>$role],200);



        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);
        }


    }


    public function getrole(getRequest $request){

        try{

            $id=$request->id;
            $role=$this->role->getRole($id);
            return response()->json(["data"=>$role],200);


        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }


    public function delete(getRequest $request){

        try{

            $id=$request->id;
            $role=$this->role->delete($id);

            return response()->json(["data"=>$role],200);



        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }



    public function getallrole(Request $request){

        try{


            return response()->json(["data"=>$this->role->getAllRole()],200);

        }catch(\Exception $ex){



            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }
}
