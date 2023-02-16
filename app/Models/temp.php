<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temp extends Model
{
    use HasFactory,HasUuids;


    public $fillable=["url","status"];
    public $hidden=["created_at","updated_at"];

    public function getUrlAttribute($value){

        $arr=[];
        $arr["200*300"]=public_path("temp/v1/".$value);
        $arr["500*700"]=public_path("temp/v2/".$value);
        $arr["1000*1200"]=public_path("temp/v3/".$value);

        return $arr;
    }


    
}
