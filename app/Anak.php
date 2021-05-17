<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    protected $table = "anak";
    protected $fillable = ['users_id','nama_anak','tempat_lhr_anak','tgl_lhr_anak','jkel_anak','pekerjaan_anak',
                            'tunjangan_anak','status_anak','pendidikan_id_anak','jurusan_id_anak'
];

    public function pegawai()
    {
        return $this->belongsTo(Users::class,'users_id','id');
    }

    public function pend()
    {
        return $this->belongsTo(Pendidikan::class,'pendidikan_id_anak','id');
    }

    public function jur()
    {
        return $this->belongsTo(Jurusan::class,'jurusan_id_anak','id');
    }


}
