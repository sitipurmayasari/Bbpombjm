<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tukin extends Model
{
    protected $table = "tukin";
    protected $fillable = ['nomor','tanggal','bulan','tahun','blnkasih','thnkasih'
];


}
