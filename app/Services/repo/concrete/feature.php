<?php 

namespace App\Services\repo\concrete;

use App\Models\feature as ModelsFeature;
use App\Services\repo\interfaces\featureInterface;
use Illuminate\Support\Facades\Cache;

class feature implements featureInterface{


    public function store($status,$critial,$from,$task_id,$base_feature_id,$description,$deadline){


        $feature=ModelsFeature::create([

            "status"=>$status,
            "critial"=>$critial,
            "task_id"=>$task_id,
            "base_feature_id"=>$base_feature_id,
            "description"=>$description,
            "deadline"=>$deadline,
            "from"=>$from

        ]);
        Cache::pull("features");
        return $feature;
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
        Cache::pull("features");
        Cache::pull("feature:".$id);
        return $feature;


    }


    public function getFeature($id){

        return Cache::rememberForever("feature:".$id,function()use($id){

            return ModelsFeature::findOrFail($id);
        });
    }

}