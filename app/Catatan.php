<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    protected $table = "catatan";
    protected $fillable = ["date","users_id","nama_sampel","kode_sampel","komuditi","foto"
                        ];

    public function getFoto() 
    {
        return $this->foto==null ? asset('images/user/userempty.png') : asset('images/catatanuji').'/'.$this->id.'/'.$this->foto;
    }

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

                            
}
