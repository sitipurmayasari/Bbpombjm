<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Klcode extends Model
{
    protected $table = "klcode";
    protected $fillable = ['code','name'];
}
