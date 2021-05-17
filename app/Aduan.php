<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
    protected $table = "aduan";
    protected $fillable = ['no_aduan','tanggal','aduan_status','pegawai_id'];

    public function getFoto() 
    {
        return $this->foto==null ? asset('images/user/barang.png') : asset('images/aduan').'/'.$this->id.'/'.$this->foto;
    }


    public function barang() //Relasi dari aduan k user / pegawai
    {
        return $this->belongsTo(Inventaris::class,'barang_id','id');
    }

    public function detail() 
    {
        return $this->belongsTo(AduanDetail::class,'id','aduan_id');
    }

    public function lapor() //Relasi dari aduan k user / pegawai
    {
        return $this->belongsTo(User::class,'pegawai_id','id');
    }

    public function tindak(){
        return $this->tindak;
    }

    public function lokasi()
    {
        return $this->hasOneThrough(
            Aduan::class,   
            Inventaris::class,      
            'lokasi',
            'barang_id', 
            'id', 
            'id'
        );
    }
}
