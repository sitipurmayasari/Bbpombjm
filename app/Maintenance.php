<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = "pemeliharaan";
    protected $fillable = ['no_pemeliharaan','tgl_pelihara','inventaris_id','pegawai_id','kegiatan','hasil','keterangan'];

    public function barang()
    {
        return $this->belongsTo(Inventaris::class,'inventaris_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'pegawai_id','id');
    }
}
