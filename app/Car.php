<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = "car";
    protected $fillable = ['code','type','merk','police_number','tax_date','police_number_date','operasional'
    ];


}
