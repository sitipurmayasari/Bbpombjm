<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outst_destiny extends Model
{
    protected $table = "outst_destiny";
    protected $fillable = ['outstation_id','destination_id','go_date','return_date','longday'
    ];

    public function destiny()
    {
        return $this->belongsTo(Destination::class,"destination_id","id");
    }

    public function out()
    {
        return $this->belongsTo(Outstation::class);
    }

}
