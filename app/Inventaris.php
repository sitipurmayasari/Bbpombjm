<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventaris extends Model
{
    use SoftDeletes;
    protected $table = "inventaris";
    protected $fillable = ["kode_barang","nama_barang","harga","kode_bmn","jenis_barang","jumlah_barang","sinonim",
                            "tanggal_diterima","merk","no_seri","lokasi","penanggung_jawab","spesifikasi","satuan_id",
                            "file_user_manual","file_ika","file_trouble","file_foto","status_barang","kind","link_video","file_sert"
                        ];
    protected $dates = ['deleted_at'];

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
        return $this->file_trouble==null ? 'Tidak Ada File' : asset('images/inventaris').'/'.$this->id.'/'.$this->file_trouble;
    }

    public function getFIleIka() 
    {
        return $this->file_ika==null ? 'Tidak Ada File' : asset('images/inventaris').'/'.$this->id.'/'.$this->file_ika;
    }
    public function getFIleUserManual() 
    {
        return $this->file_user_manual==null ? 'Tidak Ada File' : asset('images/inventaris').'/'.$this->id.'/'.$this->file_user_manual;
    }
    public function getFIleSert() 
    {
        return $this->file_sert==null ? 'Tidak Ada File' : asset('images/inventaris').'/'.$this->id.'/'.$this->file_sert;
    }

    public function getFoto() 
    {
        return $this->file_foto==null ? asset('images/user/barang.png') : asset('images/inventaris').'/'.$this->id.'/'.$this->file_foto;
    }
}
