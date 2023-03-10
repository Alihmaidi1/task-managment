<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["name","activity","status","critial","process","deadline","description","from","team_id"];

    public $hidden=["pivot","created_at","updated_at","team_id"];

    public $appends=["images"];

    public function getActivityAttribute($value){

        if($value==0){

            return "Under maintenance";

        }else if($value==1){

            return "Under Testing phase";

        }else if($value==2){

            return "Under production phase";
        }else if($value==3){

            return "in development mode";
        }

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


    public function members(){

        return $this->hasManyThrough(feature_member::class,feature::class,"task_id","feature_id");
    }


    public function features(){


        return $this->hasMany(feature::class,"task_id");
    }

    public function getStatusAttribute($value){

        if($value==0){

            return "On Hold Task";
        }else if($value==1){

            return "on Process task";
        }

        return "Stoped Task";
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


    public function comments()
    {
        return $this->morphMany(Comment::class, 'forable');
    }

    public function scopeFilter($q){

        if(request("status")){

            $q->where("status",request("status"));
        }

        if(request("activity")){

            $q->where("activity",request("activity"));
        }

        if(request("critial")){

            $q->where("critial",request("critial"));
        }

        if(request("process")){

            $q->where("process",request("process"));
        }

        if(request("deadline")){

            $q->where("deadline",request("deadline"));
        }

    }


}
