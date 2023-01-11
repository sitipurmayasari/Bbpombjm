<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pindahtangan extends Model
{
    protected $table = "pindahtangan";
    protected $fillable = ["nomor","tanggal","kelompok","inventaris_id","asal_id","alamat_lama","baru_id","alamat_baru","ket"
                        ];

    public function lama()
    {
        return $this->belongsTo(User::class,'asal_id','id');
    }
    public function baru()
    {
        return $this->belongsTo(User::class,'baru_id','id');
    }
    public function barang()
    {
        return $this->belongsTo(Inventaris::class,'inventaris_id','id');
    }
}
