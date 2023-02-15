<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    use HasFactory,HasUuids;


    public $fillable=["imageable_id","imageable_type"];

    public $hidden=["created_at","updated_at","imageable_id","imageable_type"];


    public function imageable(){

        return $this->morphTo();
    }

}
