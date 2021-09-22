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

}
