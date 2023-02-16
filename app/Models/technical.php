<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class technical extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["name"];

    public $hidden=["pivot","created_at","updated_at"];


    public function tasks(){

        return $this->morphedByMany(task::class,"technicalable");
    }



    public function features(){

        return $this->morphedByMany(feature::class,"technicalable");
    }
    
    

}
