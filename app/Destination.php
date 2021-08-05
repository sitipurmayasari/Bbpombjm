<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $table = "destination";
    protected $fillable = ['type','code','country','province','district','capital'
    ];

    public function unit()
    {
        return $this->belongsTo(Krocode::class,'krocode_id','id');
    }

}
