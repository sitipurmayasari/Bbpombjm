<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = "pengajuan";
    protected $fillable = ['no_ajuan','tgl_ajuan','status','pegawai_id','jenis_barang_id','spek'];
      

    public function kel() 
    {
        return $this->belongsTo(Jenisbrg::class,'jenis_barang_id','id');
    }

    public function detail() 
    {
        return $this->belongsTo(PengajuanDetail::class,'id','pengajuan_id');
    }

    public function lapor() //Relasi dari aduan k user / pegawai
    {
        return $this->belongsTo(User::class,'pegawai_id','id');
    }

    public function isi()
    {
        return $this->hasMany(PengajuanDetail::class,'pengajuan_id','id');
    }

  
}
