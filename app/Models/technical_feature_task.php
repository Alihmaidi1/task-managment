<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class technical_feature_task extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["technicalable_type","technicalable_id","technical_id"];
    public $hidden=["id","created_at","updated_at","technicalable_id","technicalable_type","technical_id"];

    public $appends=["technical"];

    public function technical(){

        return $this->belongsTo(technical::class,"technical_id");
    }

    public function getTechnicalAttribute(){

        
        return $this->technical()->get()[0];
        
        




    }

    public function technicalable(){


        return $this->morphTo();


    }


}
