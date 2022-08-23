<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loguser extends Model
{
    protected $table = "loguser";
    protected $fillable = ['user_id','actions','ip','agent'];

    
}