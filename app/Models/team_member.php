<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class team_member extends Model
{
    use HasFactory,HasUuids;


    public $fillable=["member_id","team_id"];
    public $hidden=["created_at","updated_at","member_id","team_id"];

    
}
