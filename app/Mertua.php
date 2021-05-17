<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mertua extends Model
{
    protected $table = "mertua";
    protected $fillable = ['users_id','nama_ayah_m','nama_ibu_m','t_lhr_ayah_m','t_lhr_ibu_m','tgl_lhr_ayah_m','tgl_lhr_ibu_m',
                            'pekerjaan_ayah_m','pekerjaan_ibu_m','telp_ayah_m','telp_ibu_m'
];

    public function pegawai()
    {
        return $this->belongsTo(Users::class,'users_id','id');
    }


}
