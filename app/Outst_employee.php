<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outst_employee extends Model
{
    protected $table = "outst_employee";
    protected $fillable = ['outstation_id','users_id', 'no_sppd'
    ];

    
    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function out()
    {
        return $this->belongsTo(Outstation::class,'outstation_id','id');
    }

}
