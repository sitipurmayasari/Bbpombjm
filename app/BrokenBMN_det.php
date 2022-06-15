<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrokenBMN_det extends Model
{
    protected $table = "brokenbmn_detail";
    protected $fillable = ['brokenbmn_id','inventaris_id','ket'];

    public function rusak()
    {
        return $this->belongsTo(BrokenBMN::class,'brokenbmn_id','id');
    }

    public function barang()
    {
        return $this->belongsTo(Inventaris::class,'inventaris_id','id');
    }

}
