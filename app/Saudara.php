<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saudara extends Model
{
    protected $table = "saudara";
    protected $fillable = ['users_id','nama_saudara','tempat_lhr_saudara','tgl_lhr_saudara','jkel_saudara',
    'pekerjaan_saudara','alamat_saudara','telp_saudara'
];

    public function pegawai()
    {
        return $this->belongsTo(Users::class,'users_id','id');
    }



}
