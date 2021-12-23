<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailsubgroup extends Model
{
    protected $table = "mailsubgroup";
    protected $fillable = ["mailgroup_id","code","names","alias"

];

    public function group()
    {
        return $this->belongsTo(Mailgroup::class,'mailgroup_id','id');
    }

  
}