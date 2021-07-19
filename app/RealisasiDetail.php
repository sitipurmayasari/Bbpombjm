<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealisasiDetail extends Model
{
    protected $table = "realisasi_detail";
    protected $fillable = ['realisasi_id','month','week','biaya'
];

    public function realisasi()
    {
        return $this->belongsTo(Realisasi::class,'realisasi_id','id');
    }


}
