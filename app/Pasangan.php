<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasangan extends Model
{
    protected $table = "pasangan";
    protected $fillable = ['users_id','nama_psg','tempat_lhr_psg','tgl_lhr_psg','jurusan_id_psg','tgl_nikah_psg',
                            'no_buku_nikah_psg','PNS_psg','tunjangan_psg','pekerjaan_psg','telp_psg'
];

    public function pegawai()
    {
        return $this->belongsTo(Users::class,'users_id','id');
    }

    public function jur()
    {
        return $this->belongsTo(Jurusan::class,'jurusan_id_psg','id');
    }


}
