<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonitorDetail extends Model
{
    protected $table = "monitor_detail";
    protected $fillable = ['monitor_id','amati_date','media_id','kontrol_id'
    ];

    
    public function monitor()
    {
        return $this->belongsTo(Monitor::class,'monitor_id','id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class,'media_id','id');
    }

    public function kontrol()
    {
        return $this->belongsTo(Kontrol::class,'kontrol_id','id');
    }

}
