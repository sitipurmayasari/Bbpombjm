<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = "jurusan";
    protected $fillable = ["pendidikan_id","jurusan"];

    public function jenjang()
    {
        return $this->belongsTo(Pendidikan::class,'pendidikan_id','id');
    }
}