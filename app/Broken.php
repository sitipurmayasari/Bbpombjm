<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Broken extends Model
{
    protected $table = "broken";
    protected $fillable = ['users_id','nomor','pejabat_id','labory_id','inventaris_id','tanggal','jumlah','satuan_id','ket','mengetahui',
    'foto'];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function lab()
    {
        return $this->belongsTo(Labory::class,'labory_id','id');
    }

    // public function mengetahui()
    // {
    //     return $this->belongsTo(Pejabat::class,'pejabat_id','id');
    // }
    
    public function tahu()
    {
        return $this->belongsTo(User::class,'mengetahui','id');
    }

    public function barang()
    {
        return $this->belongsTo(Inventaris::class,'inventaris_id','id');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class,'satuan_id','id');
    }

    public function getFoto() 
    {
        return $this->foto==null ? asset('images/user/userempty.png') : asset('images/broken').'/'.$this->id.'/'.$this->foto;
    }

}
