<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    protected $table = "pejabat";
    protected $fillable = ["jabatan_id","divisi_id","subdivisi_id","users_id","pjs","dari","sampai"];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
    public function divisi() 
    {
        return $this->belongsTo(Divisi::class);
    }
    public function subdivisi() 
    {
        return $this->belongsTo(Subdivisi::class,'subdivisi_id','id');
    }
    public function jabatan() 
    {
        return $this->belongsTo(Jabatan::class);
    }

}
