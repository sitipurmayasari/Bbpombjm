<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaguDetail extends Model
{
    protected $table = "pagudetail";
    protected $fillable = ["pagu_id","activitycode_id","subcode_id","accountcode_id",
                            "paguakhir","realisasi","sisa","detail"

];

    public function pagu()
    {
        return $this->belongsTo(Pagu::class,'pagu_id','id');
    }
    public function sub()
    {
        return $this->belongsTo(Subcode::class,'subcode_id','id');
    }

  
}