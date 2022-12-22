<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = "absensi";
    protected $fillable = ["users_id","tanggal","jam_masuk","jam_pulang","scan_masuk","scan_pulang","terlambat",
                            "pulang_cepat","tipe","ket_absen_id","poin","file","periode_year","periode_month","keterangan"
                        ];

    public function Peg()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function status()
    {
        return $this->belongsTo(KetAbsen::class,'ket_absen_id','id');
    }
  
    public function getFile() 
    {
        return $this->file==null ? 'Tidak Ada File' : asset('images/daduk').'/'.$this->id.'/'.$this->file;
    }
}
