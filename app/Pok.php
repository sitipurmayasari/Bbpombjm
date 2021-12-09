<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pok extends Model
{
    protected $table = "pok";
    protected $fillable = ['users_id','year','activitycode_id','asal_pok','asal','kode_asal','nama'
    ];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function act()
    {
        return $this->belongsTo(Activitycode::class,'activitycode_id','id');
    }

}
