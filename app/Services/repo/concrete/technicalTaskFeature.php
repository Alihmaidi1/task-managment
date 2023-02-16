<?php 

namespace App\Services\repo\concrete;

use App\Models\technical_feature_task;
use App\Services\repo\interfaces\technicalTaskFeatureInterface;

class technicalTaskFeature implements technicalTaskFeatureInterface{



    public function store($technical_id,$id,$type){



        return technical_feature_task::create([

            "technical_id"=>$technical_id,
            "technicalable_id"=>$id,
            "technicalable_type"=>$type

        ]);



    }


}