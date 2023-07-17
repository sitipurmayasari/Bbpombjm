<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengajuanDetail extends Model
{
    protected $table = "pengajuan_detail";
    protected $fillable = ["pengajuan_id","nama_barang","jumlah","satuan_id","keperluan","status","spek","inventaris_id"];
    

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class,'pengajuan_id','id');
    }

    public function satuan() 
    {
        return $this->belongsTo(Satuan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Inventaris::class,'inventaris_id','id')->withTrashed();
    }


}
