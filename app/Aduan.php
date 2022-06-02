<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
    protected $table = "aduan";
    protected $fillable = ['no_aduan','tanggal','aduan_status','pegawai_id','jenis','inventaris_id','problem','divisi_id',
                            'follow_up','result','analyze_date'];

    public function getFoto() 
    {
        return $this->foto==null ? asset('images/user/barang.png') : asset('images/aduan').'/'.$this->id.'/'.$this->foto;
    }

    public function barang()
    {
        return $this->belongsTo(Inventaris::class,'inventaris_id','id');
    }

    public function lapor() //Relasi dari aduan k user / pegawai
    {
        return $this->belongsTo(User::class,'pegawai_id','id');
    }

    public function detail() 
    {
        return $this->belongsTo(AduanDetail::class,'id','aduan_id');
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
