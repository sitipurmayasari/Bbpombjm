<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renstranas extends Model
{
    protected $table = "renstranas";
    protected $fillable = ['dates','yearfrom','yearto','types','filename','sknumber'
];

    public function pegawai()
    {
        return $this->belongsTo(Users::class,'users_id','id');
    }

}
