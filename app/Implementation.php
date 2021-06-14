<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Implementation extends Model
{
    protected $table = "implementation";
    protected $fillable = ['users_id','month','year','activitycode_id','krocode_id','detailcode_id','komponencode_id','subcode_id'
];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function act()
    {
        return $this->belongsTo(Activitycode::class,'activitycode_id','id');
    }

    public function kro()
    {
        return $this->belongsTo(Krocode::class,'krocode_id','id');
    }

    public function det()
    {
        return $this->belongsTo(Detailcode::class,'detailcode_id','id');
    }

    public function komponen()
    {
        return $this->belongsTo(Komponencode::class,'komponencode_id','id');
    }

    public function sub()
    {
        return $this->belongsTo(Subcode::class,'subcode_id','id');
    }



}
