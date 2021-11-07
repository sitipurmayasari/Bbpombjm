<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renstrakal_detail extends Model
{
    protected $table = "renstrakal_detail";
    protected $fillable = ['renstrakal_id','indicator_id','years','persentages'
];

    public function renskal()
    {
        return $this->belongsTo(Renstrakal::class,'renstrakal_id','id');
    }

    public function indi()
    {
        return $this->belongsTo(Indicator::class,'indicator_id','id');
    }

}
