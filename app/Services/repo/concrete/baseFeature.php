<?php

namespace App\Services\repo\concrete;

use App\Models\base_feature;
use App\Services\repo\interfaces\baseFeatureInterface;
use Illuminate\Support\Facades\Cache;

class baseFeature implements baseFeatureInterface{



    public function store($name){


        $base_feature=base_feature::create([

            "name"=>$name
        ]);

        Cache::pull("base_features");

        return $base_feature;
    }


    public function update($id,$name){

        $feature=base_feature::findOrFail($id);
        $feature->name=$name;
        $feature->save();
        Cache::pull("base_feature:".$id);
        Cache::pull("base_features");
        return $feature;

    }

    public function getAll(){


        return Cache::rememberForever("base_features",function(){

            return base_feature::with(["tasks"])->get();
        });
    }

    public function getOne($id){

        return Cache::rememberForever("base_feature:".$id,function() use($id){
            return base_feature::with(["tasks"])->where("id",$id)->firstOrFail();
        });
    }

    public function delete($id){

        base_feature::FindOrFail($id)->delete();
        Cache::pull("base_features");
        Cache::pull("base_feature:".$id);
    }


}
