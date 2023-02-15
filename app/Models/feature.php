<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feature extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["status","critial","process","from","task_id","base_feature_id"];


    public $hidden=["created_at","updated_at","task_id","base_feature_id"];


    public function base_feature(){

        return $this->belongsTo(base_feature::class,"base_feature_id");
    }

    public function task(){

        return $this->belongsTo(task::class,"task_id");
    }


    public function members(){

        return $this->belongsToMany(User::class,feature_member::class,"feature_id","member_id");

    }
}
