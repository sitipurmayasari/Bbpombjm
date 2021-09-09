<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $table = "destination";
    protected $fillable = ['type','code','country','province','district','capital','dailywageLK1','dailywageLK2','dailywageLK3',
    'dailywageLK4','dailywageLK5','dailywageDK1','dailywageDK2','dailywageDK3','dailywageDK4','dailywageDK5','diklat1',
    'diklat2','diklat3','diklat4','diklat5','FBDK1','FBDK2','FBDK3','FBDK4','FBDK5','FBFD1','FBFD2','FBFD3','FBFD4','FBFD5'
    ,'trans1','trans2','trans3','trans4','trans5','representatif'
    ];

}
