<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Development_det extends Model
{
    protected $table = "development_det";
    protected $fillable = ["development_id","kin_date","setup_ak_id","bukti","ak","volume"];

    public function rencana() 
    {
        return $this->belongsTo(Development::class,'development_id','id');
    }

    public function set() 
    {
        return $this->belongsTo(Setup_ak::class,'setup_ak_id','id');
    }



}
