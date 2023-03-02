<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teamleader extends Model
{
    protected $table = "teamleader";
    protected $fillable = ["users_id","detail","aktif"];

    public function peg()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
}