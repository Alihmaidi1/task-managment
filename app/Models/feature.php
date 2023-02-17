<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feature extends Model
{
    use HasFactory,HasUuids;


    public $fillable=["status","activity","critial","process","from","task_id","base_feature_id","description","deadline"];


    public $hidden=["created_at","updated_at","task_id","base_feature_id"];


    public function getStatusAttribute($value){

        if($value==0){

            return "On Hold Task";
        }

        return "in Process Task";
    }

    public function getCritialAttribute($value){

        if($value==0){

            return "Critial";
        }else if($value==1){

            return "very High";
        }else if($value==2){

            return "High";
        }else if($value==3){

            return "Medium";
        }else{

            return "Low";
        }


    }



    public function getFromAttribute($value){

        return ($value==0)?"Web Application":"Exel OR Word";

    }
    public $appends=["images","feature"];

    public function getFeatureAttribute(){

        return $this->base_feature()->get("name");
    }

    public function getImagesAttribute(){

        return $this->images()->get();

    }

    public function images(){

        return $this->morphMany(image::class,"imageable");
    }


    public function technicals(){


        return $this->morphToMany(technical::class,"technicalable");


    }
    public function base_feature(){

        return $this->belongsTo(base_feature::class,"base_feature_id");
    }

    public function task(){

        return $this->belongsTo(task::class,"task_id");
    }


    public function members(){

        return $this->belongsToMany(User::class,feature_member::class,"feature_id","member_id");

    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'forable');
    }

}
