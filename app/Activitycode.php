<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activitycode extends Model
{
    protected $table = "activitycode";
    protected $fillable = ['programcode_id','code','name','lengkap'];

    public function prog()
    {
        return $this->belongsTo(Programcode::class,'programcode_id','id');
    }

}
