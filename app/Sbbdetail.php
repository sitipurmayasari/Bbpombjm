<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sbbdetail extends Model
{
    protected $table = "sbb_detail";
    protected $fillable = ['sbb_id','inventaris_id','satuan_id','jumlah','ket','status'
];

    public function sbb()
    {
        return $this->belongsTo(Sbb::class,'sbb_id','id');
    }

    public function barang()
    {
        return $this->belongsTo(Inventaris::class,'inventaris_id','id')->withTrashed();
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class,'satuan_id','id');
    }



}
