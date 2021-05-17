<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengajuanDetail extends Model
{
    protected $table = "pengajuan_detail";
    protected $fillable = ["pengajuan_id","nama_barang","jumlah","satuan_id","keperluan","status"];
    
    public function satuan() 
    {
        return $this->belongsTo(Satuan::class);
    }


}
