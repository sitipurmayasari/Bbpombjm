<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItAsset extends Model
{
    use SoftDeletes;
    protected $table = "itasset";
    protected $fillable = ["kode_barang","nama_barang","jenistik_id","lokasi","users_id","spesifikasi","file_foto"
                        ];
    protected $dates = ['deleted_at'];

    public function penanggung() //Relasi dari inventaris k user / pegawai
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function jenisnya() //Relasi dari inventaris k user / pegawai
    {
        return $this->belongsTo(Jenistik::class,'jenistik_id','id');
    }
    
    public function getFoto() 
    {
        return $this->file_foto==null ? asset('images/user/barang.png') : asset('images/itasset').'/'.$this->id.'/'.$this->file_foto;
    }
}
