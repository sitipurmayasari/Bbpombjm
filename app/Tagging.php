<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagu extends Model
{
    protected $table = "tagging";
    protected $fillable = ["pagu_id","subcode_id","pagusub","realisasisub","indicator_id",
                            "ikupersen","paguiku","realisasiiku"

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