<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatPend extends Model
{
    protected $table = "riwayat_pend";
    protected $fillable = ['users_id','pendidikan_id','jurusan_id','nama_sekolah','alamat','thn_lulus'
];

    public function pegawai()
    {
        return $this->belongsTo(Users::class,'users_id','id');
    }

    public function jur()
    {
        return $this->belongsTo(Jurusan::class,'jurusan_id','id');
    }

    public function sekolah()
    {
        return $this->belongsTo(Jurusan::class,'pendidikan_id','id');
    }


}
