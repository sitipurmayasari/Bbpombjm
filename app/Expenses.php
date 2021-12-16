<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $table = "expenses";
    protected $fillable = ['date','outstation_id'
];

    public function st()
    {
        return $this->belongsTo(Outstation::class,'outstation_id','id');
    }

    public function filess()
    {
        return $this->hasMany(Travelexpenses::class,'expenses_id','id');
    }


}
