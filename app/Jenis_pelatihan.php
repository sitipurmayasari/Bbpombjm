<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis_pelatihan extends Model
{
    protected $table = "jenis_pelatihan";
    protected $fillable = ["name"];
}
