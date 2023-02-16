<?php

namespace App\Http\Controllers;

use App\Http\Requests\task\delete;
use App\Http\Requests\task\store;
use App\Http\Requests\task\update;
use App\Http\Requests\task\updateteam;
use App\Services\fileOperation\intervenationImage;
use App\Services\repo\interfaces\imageInterface;
use App\Services\repo\interfaces\taskInterface;
use Illuminate\Http\Request;
use File;

class task extends Controller
{

    public $task;
    public $temp;
    public $image;
    public function __construct(taskInterface $task,imageInterface $temp){

        $this->task=$task;
        $this->temp=$temp;
        $this->image=new intervenationImage($temp);
    }




    public function store(store $request){

        try{

            $name=$request->name;
            $status=$request->status;
            $critial=$request->critial;
            $deadline=$request->deadline;
            $team_id=$request->team_id;
            $description=$request->description;
            $technicals=$request->technicals;
            $images=$request->images;
            $task=$this->task->store($name,$status,$critial,$deadline,$team_id,$description,0);            
            $task->technicals()->sync($technicals);
            $this->temp->saveImages($images,"task",$task->id);
            $task->technicals;
            $task->team;
            return response()->json(["data"=>$task],200);



        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }


    public function update(update $request){
        try{

            $id=$request->id;
            $name=$request->name;
            $status=$request->status;
            $critial=$request->critial;
            $deadline=$request->deadline;
            $description=$request->description;
            $deleted_image=$request->deleted_image;
            $images=$request->image;
            $technicals=$request->technicals;
            $this->temp->deleteImage($deleted_image,"task");
            $task=$this->task->update($id,$name,$status,$critial,$deadline,$description);
            $this->temp->saveImages($images,"task",$id);  
            $task->technicals()->sync($technicals);           
            $task->technicals;
            $task->team;           
            return response()->json(["data"=>$task],200);


        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);
        }



    }


    public function updateteam(updateteam $request){

        try{

            $id=$request->task_id;
            $team_id=$request->team_id;
            $task=$this->task->getTask($id);
            if($task->team_id==$team_id){
                return response()->json(["data"=>$task],200);
            }
            $task->members()->delete();
            $task->team_id=$team_id;
            $task->save();
            $task->technicals;
            $task->team;           
       
            return response()->json(["data"=>$task]);
            



            
        }catch(\Exception $ex){



            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }


    public function getalltask(Request $request){

        try{



            return response()->json(["data"=>$this->task->getAllTask()],200);


        }catch(\Exception $ex){

            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }



    public function delete(delete $request){

        try{

            $task=$this->task->getTask($request->id);
            $features=$task->features;
            foreach($features as $feature){

                File::deleteDirectory(public_path("feature/v1/".$feature->id));
                File::deleteDirectory(public_path("feature/v2/".$feature->id));
                File::deleteDirectory(public_path("feature/v3/".$feature->id));
                $feature->technicals()->delete();
                $feature->images()->delete();
                
            }
            File::deleteDirectory(public_path("task/v1/".$task->id));
            File::deleteDirectory(public_path("task/v2/".$task->id));
            File::deleteDirectory(public_path("task/v3/".$task->id));
            $task->delete();
            return response()->json([],200);

        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }
}
