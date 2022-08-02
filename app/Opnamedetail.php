<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opnamedetail extends Model
{
    protected $table = "opnamedetail";
    protected $fillable = ['opname_id','inventaris_id','stok_kartu','stok_fisik','selisih','keterangan'];

    public function barang()
    {
        return $this->belongsTo(Inventaris::class,'inventaris_id','id');
    }
    public function opname()
    {
        return $this->belongsTo(Opname::class,'opname_id','id');
    }



}
