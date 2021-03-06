<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailclasification extends Model
{
    protected $table = "mailclasification";
    protected $fillable = ["mailsubgroup_id","code","names","alias","actived","innactive","thelast",
                            "ketactive","ketinactive","akhir","securitiesklas","internal","eksternal"

];

    public function subgroup()
    {
        return $this->belongsTo(Mailsubgroup::class,'mailsubgroup_id','id');
    }

}