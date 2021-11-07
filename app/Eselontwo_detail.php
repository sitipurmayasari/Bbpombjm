<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eselontwo_detail extends Model
{
    protected $table = "eselontwo_detail";
    protected $fillable = ['eselontwo_id', 'indicator_id','twI','twII','twIII','twIV'
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
