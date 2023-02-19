<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    public $fillable=["content","forable_id","forable_type","fromable_id","fromable_type"];


    public $hidden=["id","updated_at","forable_id","forable_type","fromable_id","fromable_type"];

    public $appends=["user","type"];

    public function getUserAttribute(){


        return $this->fromable()->get();

    }

    public function getTypeAttribute(){

        return $this->forable()->get();
    }


    public function forable()
    {
        return $this->morphTo();
    }

    public function fromable()
    {
        return $this->morphTo();
    }




}
