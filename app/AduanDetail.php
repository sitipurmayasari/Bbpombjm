<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AduanDetail extends Model
{
    protected $table = "aduan_detail";
    protected $fillable = ["aduan_id","barang_id","keterangan","follow_up","result","status"];
    
    public function aduan()
    {
        return $this->belongsTo(Aduan::class,'aduan_id','id');
    }

    public function barang()
    {
        return $this->belongsTo(Inventaris::class,'barang_id','id');
    }

}
