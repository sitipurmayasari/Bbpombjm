<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outstation extends Model
{
    protected $table = "outstation";
    protected $fillable = ['divisi_id','st_date','number','purpose','budget_id','ppk_id','pok_id','city_from','type',
    'city_1','date_from_1','date_to_1','daylong_1','city_2','date_from_2','date_to_2','daylong_2'
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class,'divisi_id','id');
    }
    public function budget()
    {
        return $this->belongsTo(Budget::class,'budget_id','id');
    }

    public function ppk()
    {
        return $this->belongsTo(PPK::class,'ppk_id','id');
    }

    public function city_from()
    {
        return $this->belongsTo(Destination::class,'city_from','id');
    }
    public function city_1()
    {
        return $this->belongsTo(Destination::class,'city_1','id');
    }
    public function city_2()
    {
        return $this->belongsTo(Destination::class,'city_2','id');
    }

}
