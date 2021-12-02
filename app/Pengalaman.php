<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengalaman extends Model
{
    protected $table = "pengalaman";
    protected $fillable = ['users_id','tgl_mulai','instansi','jabatan','lama_thn','lama_bln','tgl_selesai'
];

    public function pegawai()
    {
        return $this->belongsTo(Users::class,'users_id','id');
    }

    
}
