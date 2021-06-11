<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Implementation extends Model
{
    protected $table = "implementation";
    protected $fillable = ['users_id','month','year','activitycode_id'
];

    public function pegawai()
    {
        return $this->belongsTo(Users::class,'users_id','id');
    }

    public function act()
    {
        return $this->belongsTo(Activitycode::class,'activitycode_id','id');
    }



}
