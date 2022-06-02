<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AduanDetail extends Model
{
    protected $table = "aduan_detail";
    protected $fillable = ["aduan_id","inventaris_id","keterangan","follow_up","result"];
    
    public function aduan()
    {
        return $this->belongsTo(Aduan::class,'aduan_id','id');
    }

    public function barang()
    {
        return $this->belongsTo(Inventaris::class,'inventaris_id','id');
    }

}
