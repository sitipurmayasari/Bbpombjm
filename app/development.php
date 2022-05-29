<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Development extends Model
{
    protected $table = "development";
    protected $fillable = ["skp_id","plan_date"];

    public function skp() 
    {
        return $this->belongsTo(Skp::class,'skp_id','id');
    }

}
