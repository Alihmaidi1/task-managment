<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory,HasUuids;


    public $fillable=["name","permissions"];


    public $hidden=["created_at","updated_at"];


    public function getPermissionsAttribute($value){


        return json_decode($value);
    }


    public function admins(){


        return $this->hasMany(admin::class,"role_id");
    }

}