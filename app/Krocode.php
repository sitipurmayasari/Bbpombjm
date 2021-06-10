<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Krocode extends Model
{
    protected $table = "krocode";
    protected $fillable = ['code','name'];
}
