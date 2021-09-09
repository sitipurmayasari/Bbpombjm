<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = "driver";
    protected $fillable = ['outstation_id','driver_id','car_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'driver_id','id');
    }

    public function out()
    {
        return $this->belongsTo(Outstation::class,'outstation_id','id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class,'car_id','id');
    }

}
