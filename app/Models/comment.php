<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    public $fillable=["content","forable_id","forable_type","fromable_id","fromable_type"];


    public $hiiden=["created_at","updated_at"];


    public function forable()
    {
        return $this->morphTo();
    }

    public function fromable()
    {
        return $this->morphTo();
    }




}
