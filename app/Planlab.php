<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planlab extends Model
{
    protected $table = "planlab";
    protected $fillable = ["no_ajuan","tgl_ajuan", "users_id", "labory_id", "years","pejabat_id"];

    public function lab() 
    {
        return $this->belongsTo(Labory::class,'labory_id','id');
    }

    public function user() 
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

}