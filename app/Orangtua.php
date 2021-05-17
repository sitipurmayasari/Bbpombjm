<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orangtua extends Model
{
    protected $table = "orangtua";
    protected $fillable = ['users_id','nama_ayah','nama_ibu','t_lhr_ayah','t_lhr_ibu','tgl_lhr_ayah','tgl_lhr_ibu',
                            'pekerjaan_ayah','pekerjaan_ibu','telp_ayah','telp_ibu','alamat_ayah','alamat_ibu'
];

    public function pegawai()
    {
        return $this->belongsTo(Users::class,'users_id','id');
    }


}
