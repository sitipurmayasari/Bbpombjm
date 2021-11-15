<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setuprenker extends Model
{
    protected $table = "setuprenker";
    protected $fillable = ['jenis','rentang_awal','rentang_akhir','capaian','kriteria'
];



}
