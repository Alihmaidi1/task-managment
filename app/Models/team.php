<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    use HasFactory,HasUuids;


    public $fillable=["name"];

    public $hidden=["created_at","updated_at"];

    public function members(){

        return $this->belongsToMany(User::class,team_member::class,"team_id","member_id");
    }


    public $appends=["members"];


    public function getMembersAttribute(){

        return $this->members()->get();

    }


    public function tasks(){


        return $this->hasMany(task::class,"team_id");
    }


}
