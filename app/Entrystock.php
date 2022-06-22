<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrystock extends Model
{
    protected $table = "entrystock";
    protected $fillable = ['inventaris_id','entry_date','stock','exp_date','stockawal','harga','keluar'
];

    public function barang()
    {
        return $this->belongsTo(Inventaris::class,'inventaris_id','id');
    }


}
