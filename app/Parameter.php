<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $table = "parameter";
    protected $fillable = ['komuditi','nama'];

}
