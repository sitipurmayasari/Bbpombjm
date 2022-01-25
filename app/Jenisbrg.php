<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenisbrg extends Model
{
    protected $table = "jenis_barang";
    protected $fillable = ["nama","kelompok"];
}
