<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admin extends Authenticatable
{
    use HasFactory,HasUuids,HasApiTokens;


    public $fillable=["name","email","role_id","password"];
    public $hidden=["created_at","updated_at","role_id","password"];


    public function comments()
    {
        return $this->morphMany(Comment::class, 'fromable');
    }


    public function role(){


        return $this->belongsTo(role::class,"role_id");
    }

    // public $appends=["role"];


    // public function getRoleAttribute(){

    //     return $this->role()->get();
    // }

}
