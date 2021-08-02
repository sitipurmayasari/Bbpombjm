<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $table = "indicator";
    protected $fillable = ["target_id","komponencode_id","indicator","poin"];

    public function target()
    {
        return $this->belongsTo(Target::class,'target_id','id');
    }

    public function komponen()
    {
        return $this->belongsTo(Komponencode::class,'komponencode_id','id');
    }
}