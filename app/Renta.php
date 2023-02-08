<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renta extends Model
{
    protected $table = "renta";
    protected $fillable = ['eselontwo_id','users_id','divisi_id','periodebln','dates','verif'
];

    public function eselon()
    {
        return $this->belongsTo(Eselontwo::class,'eselontwo_id','id');
    }

    public function peg()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function div()
    {
        return $this->belongsTo(Divisi::class,'divisi_id','id');
    }

}
