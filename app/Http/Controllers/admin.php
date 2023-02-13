<?php

namespace App\Http\Controllers;

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


}
