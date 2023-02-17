<?php 

namespace App\Services\repo\concrete;

use App\Models\task as ModelsTask;
use App\Models\technical_feature_task;
use App\Services\repo\interfaces\taskInterface;
use App\Services\repo\interfaces\technicalTaskFeatureInterface;
use Illuminate\Support\Facades\Cache;

class task implements taskInterface{


    public function store($name,$status,$critial,$deadline,$team_id,$description,$from){


        $task=ModelsTask::create([

            "name"=>$name,
            "status"=>$status,
            "critial"=>$critial,
            "deadline"=>$deadline,
            "team_id"=>$team_id,
            "from"=>$from,
            "description"=>$description

        ]);

        Cache::pull("tasks");
        return $task;

    }

    public function update($id,$name,$status,$critial,$deadline,$description){

        $task=ModelsTask::FindOrFail($id);
        $task->name=$name;
        $task->status=$status;
        $task->critial=$critial;
        $task->deadline=$deadline;
        $task->description=$description;
        $task->save();
        Cache::pull("tasks");
        Cache::pull("task:".$task->id);
        return $task;


    }


    public function getTask($id){

        return Cache::rememberForever("task:".$id,function()use($id){

            return ModelsTask::findOrFail($id);
        });
    }

    public function getAllTask(){


        return Cache::rememberForever("tasks",function(){

            return ModelsTask::with(["technicals","team","features"])->get();
        });
    }

    


}