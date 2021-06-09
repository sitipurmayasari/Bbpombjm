<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $table = "inventaris";
    protected $fillable = ["kode_barang","nama_barang","harga","kode_bmn","jenis_barang","jumlah_barang",
                            "tanggal_diterima","merk","no_seri","lokasi","penanggung_jawab","spesifikasi","satuan_id",
                            "file_user_manual","file_ika","file_trouble","file_foto","status_barang","kind"
                        ];

    public function penanggung() //Relasi dari inventaris k user / pegawai
    {
        return $this->belongsTo(User::class,'penanggung_jawab','id');
    }
    public function location() //Relasi dari inventaris k lokasi
    {
        return $this->belongsTo(Lokasi::class,'lokasi','id');
    }

    public function jenis() //Relasi dari inventaris k lokasi
    {
        return $this->belongsTo(Jenisbrg::class,'jenis_barang','id');
    }

    public function satuan() //Relasi dari inventaris k lokasi
    {
        return $this->belongsTo(Satuan::class,'satuan_id','id');
    }

    public function getFIleTrouble() 
    {
        return $this->file_trouble==null ? 'Tidak Ada File' : asset('images/inventaris').'/'.$this->id.'/'.$this->file_user_manual;
    }

    public function getFIleIka() 
    {
        return $this->file_ika==null ? 'Tidak Ada File' : asset('images/inventaris').'/'.$this->id.'/'.$this->file_user_manual;
    }

    public function getFIleUserManual() 
    {
        return $this->file_user_manual==null ? 'Tidak Ada File' : asset('images/inventaris').'/'.$this->id.'/'.$this->file_user_manual;
    }

    public function getFoto() 
    {
        return $this->file_foto==null ? asset('images/user/userempty.png') : asset('images/inventaris').'/'.$this->id.'/'.$this->file_foto;
    }
}
