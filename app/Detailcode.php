<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailcode extends Model
{
    protected $table = "detailcode";
    protected $fillable = ['krocode_id','code','name'];

    public function unit()
    {
        return $this->belongsTo(Krocode::class,'krocode_id','id');
    }

}
