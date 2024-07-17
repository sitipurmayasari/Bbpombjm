<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rotasi extends Model
{
    protected $table = "rotasi";
    protected $fillable = ['dates','users_id','evaluator','status','placementDate','old','new','information','min','stats'];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }


    public function penilai()
    {
        return $this->belongsTo(User::class,'evaluator','id');
    }


    
}
