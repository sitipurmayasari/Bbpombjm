<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = "divisi";
    protected $fillable = ["nama","kode_unit","kode_sppd"];

}
