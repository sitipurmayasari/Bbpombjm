<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renstrakal extends Model
{
    protected $table = "renstrakal";
    protected $fillable = ['dates','yearfrom','yearto','types','filename','sknumber'
];

    public function pegawai()
    {
        return $this->belongsTo(Users::class,'users_id','id');
    }

}
