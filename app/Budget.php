<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $table = "budget";
    protected $fillable = ['code','name','nomor','tanggal','tahun'
    ];


}
