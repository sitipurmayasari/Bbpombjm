<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eselontwo_detail extends Model
{
    protected $table = "eselontwo_detail";
    protected $fillable = ['eselontwo_id', 'indicator_id','setahun','jan','feb','mar','apr','mei','jun','jul','aug',
                            'sep','oct','nov','dec'
    ];

    public function eselon()
    {
        return $this->belongsTo(Eselontwo::class,'eselontwo_id','id');
    }

    public function indi()
    {
        return $this->belongsTo(Indicator::class,'indicator_id','id');
    }




}
