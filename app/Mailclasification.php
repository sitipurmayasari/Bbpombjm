<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailclasification extends Model
{
    protected $table = "mailclasification";
    protected $fillable = ["mailsubgroup_id","code","names","alias","actived","innactive","ceking","thelast"

];

    public function subgroup()
    {
        return $this->belongsTo(Mailgroup::class,'mailsubgroup_id','id');
    }

  
}