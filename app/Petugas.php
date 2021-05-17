<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = "petugas";
    protected $fillable = ["jenis","user_id"];

    public function user() //Relasi dari inventaris k user / pegawai
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
