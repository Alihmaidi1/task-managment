<?php 

namespace App\Services\repo\concrete;

use App\Models\base_feature;
use App\Services\repo\interfaces\baseFeatureInterface;

class baseFeature implements baseFeatureInterface{



    public function store($name){


        return base_feature::create([

            "name"=>$name
        ]);

    }


    public function update($id,$name){

        $feature=base_feature::findOrFail($id);
        $feature->name=$name;
        $feature->save();
        return $feature;
        
    }

    public function getAll(){


        return base_feature::with(["tasks"])->get();
    }

    public function getOne($id){

        return base_feature::with(["tasks"])->where("id",$id)->firstOrFail();
    }

    public function delete($id){

        base_feature::FindOrFail($id)->delete(); 
    }


}