<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linkaluh extends Model
{
    protected $table = "linkaluh";
    protected $fillable = ['year','indicator_id','name','link', 'aktif'];


    
    public function indi()
    {
        return $this->belongsTo(Indicator::class,'indicator_id','id');
    }
    
}