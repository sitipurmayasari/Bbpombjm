<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalCar extends Model
{
    protected $table = "jadwalcar";
    protected $fillable = ["car_id","tanggal",];

    public function mobil() //Relasi dari aduan k user / pegawai
    {
        return $this->belongsTo(car::class,'car_id','id');
    }

    public function penanggung()
    {
        return $this->hasOneThrough(
            JadwalMain::class,   
            Inventaris::class,      
            'name',
            'car_id', 
            'id', 
            'id'
        );
    }

}
