<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setabsen extends Model
{
    protected $table = "setabsen";
    protected $fillable = ['kunci_tanggal','poin1','poin16','poin31','poin61','poin91' 
];



}
