<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opname extends Model
{
    protected $table = "opname";
    protected $fillable = ['periode','dates','upload_by'];

    public function user()
    {
        return $this->belongsTo(User::class,'upload_by','id');
    }



}
