<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support_det extends Model
{
    protected $table = "support_det";
    protected $fillable = ["support_id","kin_date","setup_ak_id","bukti","ak","volume"];

    public function rencana() 
    {
        return $this->belongsTo(Support::class,'support_id','id');
    }

    public function set() 
    {
        return $this->belongsTo(Setup_ak::class,'setup_ak_id','id');
    }



}
