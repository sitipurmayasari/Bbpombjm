<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PPK extends Model
{
    protected $table = "ppk";
    protected $fillable = ['code', 'users_id','jabatan'];

    public function user() //Relasi  k user / pegawai
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

}
