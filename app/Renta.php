<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renta extends Model
{
    protected $table = "renta";
    protected $fillable = ['renstrakal_id','years','ket'
];

    public function renstrakal()
    {
        return $this->belongsTo(Renstrakal::class,'renstrakal_id','id');
    }

}
