<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renta_det extends Model
{
    protected $table = "renta_detail";
    protected $fillable = ['renta_id','eselontwo_detail_id','sebulan','capaian','keterangan'
    ];

    public function renta()
    {
        return $this->belongsTo(Renta::class,'renta_id','id');
    }

    public function ed_det()
    {
        return $this->belongsTo(Eselontwo_detail::class,'eselontwo_detail_id','id');
    }

}
