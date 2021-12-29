<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stbook extends Model
{
    protected $table = "stbook";
    protected $fillable = ['divisi_id','stbook_date','stbook_number'
                        ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class,'divisi_id','id');
    }

    public function sppd()
    {
        return $this->hasMany(Stbook_sppd::class,'stbook_id','id');
    }

}
