<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class technical_feature_task extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["technicalable_type","technicalable_id"];
    public $hidden=["created_at","updated_at","technicalable_id","technicalable_type"];


    public function technicalable(){


        return $this->morphTo();


    }


}
