<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linkaluh extends Model
{
    protected $table = "linkaluh";
    protected $fillable = ['name','link', 'aktif'];

    
}