<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perencanaan_det extends Model
{
    protected $table = "perencanaan_det";
    protected $fillable = ["perencanaan_id","kin_date","skp_detail_id","setup_ak_id","nilai_ak"];

    public function rencana() 
    {
        return $this->belongsTo(Perencanaan::class,'perencanaan_id','id');
    }

    public function detail() 
    {
        return $this->belongsTo(Skp_detail::class,'skp_detail_id','id');
    }

    public function set() 
    {
        return $this->belongsTo(Setup_ak::class,'setup_ak_id','id');
    }



}
