<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $table = "indicator";
    protected $fillable = ["target_id","indicator","divisi_id","ikucode"];

    public function target()
    {
        return $this->belongsTo(Target::class,'target_id','id');
    }

    public function sub()
    {
        return $this->belongsTo(Subcode::class,'subcode_id','id');
    }

    public function div()
    {
        return $this->belongsTo(Divisi::class,'divisi_id','id');
    }
}