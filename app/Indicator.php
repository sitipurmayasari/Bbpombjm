<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $table = "indicator";
    protected $fillable = ["target_id","subcode_id","indicator","poin"];

    public function target()
    {
        return $this->belongsTo(Target::class,'target_id','id');
    }

    public function sub()
    {
        return $this->belongsTo(Subcode::class,'subcode_id','id');
    }
}