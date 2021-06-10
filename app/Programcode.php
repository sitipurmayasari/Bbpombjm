<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programcode extends Model
{
    protected $table = "programcode";
    protected $fillable = ['unitcode_id','code','name'];

    public function unit()
    {
        return $this->belongsTo(Unitcode::class,'unitcode_id','id');
    }
}
