<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setupttd extends Model
{
    protected $table = "setup_ttd";
    protected $fillable = ["users_id","scan_ttd"];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function getFoto() 
    {
        return $this->scan_ttd==null ? asset('images/user/userempty.png') : asset('images/ttd').'/'.$this->id.'/'.$this->scan_ttd;
    }
}