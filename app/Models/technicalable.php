<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class technicalable extends Model
{
    use HasFactory;

    public $fillable=["technicalable_type","technicalable_id","technical_id"];
    public $hidden=["created_at","updated_at","technicalable_id","technicalable_type","technical_id"];

   
   
   
}
