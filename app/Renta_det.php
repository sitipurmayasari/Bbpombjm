<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renta_det extends Model
{
    protected $table = "renta_detail";
    protected $fillable = ['renta_id','renstrakal_detail_id','setahun','indicator_id','jan','feb','mar','apr','mei','jun','jul','aug',
                            'sep','oct','nov','dec'
];

    public function renta()
    {
        return $this->belongsTo(Renta::class,'renta_id','id');
    }

    public function tahunan()
    {
        return $this->belongsTo(Renstakal_detail::class,'renstrakal_detail_id','id');
    }

    public function indi()
    {
        return $this->belongsTo(Indicator::class,'indicator_id','id');
    }

}
