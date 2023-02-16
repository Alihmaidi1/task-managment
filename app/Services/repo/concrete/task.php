<?php 

namespace App\Services\repo\concrete;

use App\Models\task as ModelsTask;
use App\Models\technical_feature_task;
use App\Services\repo\interfaces\taskInterface;
use App\Services\repo\interfaces\technicalTaskFeatureInterface;

class task implements taskInterface{

    public $technicalTaskFeature;

    public function __construct(technicalTaskFeatureInterface $technicalTaskFeature){

        $this->technicalTaskFeature=$technicalTaskFeature;

    }
    public function store($name,$status,$critial,$deadline,$team_id,$description,$from){


        return ModelsTask::create([

            "name"=>$name,
            "status"=>$status,
            "critial"=>$critial,
            "deadline"=>$deadline,
            "team_id"=>$team_id,
            "from"=>$from,
            "description"=>$description

        ]);


    }

    public function update($id,$name,$status,$critial,$deadline,$description){

        $task=ModelsTask::FindOrFail($id);
        $task->name=$name;
        $task->status=$status;
        $task->critial=$critial;
        $task->deadline=$deadline;
        $task->description=$description;
        $task->save();

        return $task;


    }
    public function storeTechnical($technicals,$id){



        foreach($technicals as $technical){

            $this->technicalTaskFeature->store($technical,$id,"App\\Models\\task");

        }
        

    }

    public function updateTechnical($technicals,$id){

        technical_feature_task::where("technicalable_id",$id)->where("technicalable_type","App\\Models\\task")->delete();
        $this->storeTechnical($technicals,$id);



    }

    public function getTask($id){

        return ModelsTask::findOrFail($id);
    }

    public function getAllTask(){


        return ModelsTask::all();
    }

    


}