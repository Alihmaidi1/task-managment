<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name','email','password',"gender","url","date_of_birth"];

    protected $hidden = ['password',"created_at","updated_at","pivot"];


    public function comments()
    {
        return $this->morphMany(Comment::class, 'fromable');
    }

    public function getGenderAttribute($value){


        return ($value==0)?"male":"female";

    }


    public function getUrlAttribute($value){

        $arr=[];
        $arr["200*300"]=public_path("member/v1/".$value);
        $arr["500*700"]=public_path("member/v2/".$value);
        $arr["1000*1200"]=public_path("member/v3/".$value);

        return $arr;


    }


    public function teams(){


        return $this->belongsToMany(team::class,team_member::class,"member_id","team_id");
    }


    public function features(){

        return $this->belongsToMany(feature::class,feature_member::class,"member_id","feature_id");
    }

}
