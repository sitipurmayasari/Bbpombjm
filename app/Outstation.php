<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outstation extends Model
{
    protected $table = "outstation";
    protected $fillable = ['users_id','from','to','type','destination','car_office','driver','car_id'
    ];

    public function user()
    {
        return $this->belongsTo(Users::class,'users_id','id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class,'car_id','id');
    }

}
