<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["name","status","critial","process","deadline","description","from","team_id"];

    public $hidden=["created_at","updated_at","team_id"];

    public function images(){


        return $this->morphMany(image::class,"imageable");


    }

    public function technicals(){


        return $this->morphMany(technical_feature_task::class,"technicalable");


    }


    public function features(){


        return $this->hasMany(feature::class,"task_id");
    }

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


    public function team(){

        return $this->belongsTo(team::class,"team_id");


    }
}
