<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    use HasFactory,HasUuids;


    public $fillable=["imageable_id","imageable_type","url"];

    public $hidden=["created_at","updated_at","imageable_id","imageable_type"];


    public function imageable(){

        return $this->morphTo();
    }

    public function getUrlAttribute($value){

        $arr=[];
        $type=($this->imageable_type=="App\\Models\\task")?"task":"feature";
        $arr["200*300"]=public_path($type."/v1/".$value);
        $arr["500*700"]=public_path($type."/v2/".$value);
        $arr["1000*1200"]=public_path($type."/v3/".$value);
        return $arr;

    }

}
