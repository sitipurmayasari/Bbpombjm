<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renstranas_detail extends Model
{
    protected $table = "renstranas_detail";
    protected $fillable = ['renstranas_id','indicator_id','years','persentages'
];

    public function rensnas()
    {
        return $this->belongsTo(Renstranas::class,'renstranas_id','id');
    }

    public function indi()
    {
        return $this->belongsTo(Indicator::class,'indicator_id','id');
    }

}
