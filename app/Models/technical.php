<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class technical extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["name"];

    public $hidden=["created_at","updated_at"];
}
