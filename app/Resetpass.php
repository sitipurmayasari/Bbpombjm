<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resetpass extends Model
{
    protected $table = "resetpass";
    protected $fillable = ['defaultpass','newpass','resetbefore'
];


}
