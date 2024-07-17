<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RotasiGrade extends Model
{
    protected $table = "rotasi_grade";
    protected $fillable = ['rotasi_id','statement','values'];

    public function rotasi()
    {
        return $this->belongsTo(Rotasi::class,'rotasi_id','id');
    }
    
}
