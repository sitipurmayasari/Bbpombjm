<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = "users";
    protected $fillable = ["no_pegawai","name","username","email","password",
                            "tgl_lhr","alamat","telp","jabatan_id","status",
                            "divisi_id","subdivisi_id","foto"];

    public function getFoto() 
    {
        return $this->foto==null ? asset('images/user/userempty.png') : asset('images/pegawai').'/'.$this->id.'/'.$this->foto;
    }

    public function divisi() 
    {
        return $this->belongsTo(Divisi::class);
    }

    public function subdivisi() 
    {
        return $this->belongsTo(Subdivisi::class);
    }

    public function jabatan() 
    {
        return $this->belongsTo(Jabatan::class);
    }
                            
}
