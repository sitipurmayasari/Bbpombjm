<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setup_ak extends Model
{
    protected $table = "setup_ak";
    protected $fillable = ['unsur','sub_unsur','kode_ak','uraian','hasil','kak','ak','pelaksana','pertama','muda','madya','utama'
];



}
