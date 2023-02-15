<?php

namespace App\Http\Controllers;

use App\Http\Requests\task\store;
use App\Services\repo\interfaces\taskInterface;
use Illuminate\Http\Request;

class task extends Controller
{

    public $task;

    public function __construct(taskInterface $task){

        $this->task=$task;

    }

    public function store(store $request){

        try{

            


            return null;


        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }

}
