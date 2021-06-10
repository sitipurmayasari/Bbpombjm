<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activitycode extends Model
{
    protected $table = "activitycode";
    protected $fillable = ['programcode_id','code','name'];

    public function unit()
    {
        return $this->belongsTo(Programcode::class,'programcode_id','id');
    }

}
