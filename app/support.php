<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = "support";
    protected $fillable = ["skp_id","plan_date"];

    public function skp() 
    {
        return $this->belongsTo(Skp::class,'skp_id','id');
    }

}
