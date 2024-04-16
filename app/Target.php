<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $table = "target";
    protected $fillable = ["perspective_id","name","code"];

    public function pers()
    {
        return $this->belongsTo(Perspective::class,'perspective_id','id');
    }
}