<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalMain extends Model
{
    protected $table = "jadwal_main";
    protected $fillable = ["inventaris_id","tanggal",];

    public function barang() //Relasi dari aduan k user / pegawai
    {
        return $this->belongsTo(Inventaris::class,'inventaris_id','id');
    }

    public function penanggung()
    {
        return $this->hasOneThrough(
            JadwalMain::class,   
            Inventaris::class,      
            'name',
            'inventaris_id', 
            'id', 
            'id'
        );
    }

}
