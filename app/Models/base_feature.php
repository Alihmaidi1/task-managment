<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class base_feature extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["name"];
    public $hidden=["created_at","updated_at"];

    public function features(){


        return $this->hasMany(feature::class,"base_feature_id");
    }

    public function tasks(){

        return $this->belongsToMany(task::class,feature::class,"base_feature_id","task_id");
    }
}
