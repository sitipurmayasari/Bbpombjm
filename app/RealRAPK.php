<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealRAPK extends Model
{
  
    protected $table = "realrapk";
    protected $fillable = [ 'dates','years','filename','users_id','kapom_id','triwulan','eselontwo_id','pagu_id'
    ];

    public function pejabat()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function kapom()
    {
        return $this->belongsTo(User::class,'kapom_id','id');
    }

    public function eselon()
    {
        return $this->belongsTo(Eselontwo::class,'eselontwo_id','id');
    }
}
