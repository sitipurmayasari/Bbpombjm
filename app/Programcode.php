<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programcode extends Model
{
    protected $table = "programcode";
    protected $fillable = ['code','name'];
}
