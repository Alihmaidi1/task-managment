<?php 

namespace App\Services\repo\concrete;

use App\Models\feature as ModelsFeature;
use App\Services\repo\interfaces\featureInterface;

class feature implements featureInterface{


    public function store($status,$critial,$from,$task_id,$base_feature_id,$description,$deadline){


        return ModelsFeature::create([

            "status"=>$status,
            "critial"=>$critial,
            "task_id"=>$task_id,
            "base_feature_id"=>$base_feature_id,
            "description"=>$description,
            "deadline"=>$deadline,
            "from"=>$from

        ]);


    }


    public function update($id,$status,$critial,$task_id,$base_feature_id,$description,$deadline){

        $feature=ModelsFeature::findOrFail($id);
        $feature->status=$status;
        $feature->critial=$critial;
        $feature->task_id=$task_id;
        $feature->base_feature_id=$base_feature_id;
        $feature->description=$description;
        $feature->deadline=$deadline;
        $feature->save();

        return $feature;


    }


    public function getFeature($id){

        return ModelsFeature::findOrFail($id);
    }

}