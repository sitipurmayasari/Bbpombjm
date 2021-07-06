<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit_poin extends Model
{
    protected $table = "credit_poin";
    protected $fillable = ['users_id','dari','sampai','jumlah','status','dupak_id'
    ];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

}
