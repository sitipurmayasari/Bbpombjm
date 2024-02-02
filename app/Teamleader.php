<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teamleader extends Model
{
    protected $table = "teamleader";
    protected $fillable = ["users_id","detail","aktif","divisi_id","datefrom","dateto"];

    public function peg()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class,'divisi_id','id');
    }
}