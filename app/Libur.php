<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libur extends Model
{
    protected $table = "libur";
    protected $fillable = ['tanggal','keterangan'];

    
}