<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = "dokumen";
    protected $fillable = ['users_id','jendok_id','nomor','upload','tanggal'
];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
    public function jenis()
    {
        return $this->belongsTo(Jendok::class,'jendok_id','id');
    }

    public function getFIleDok() 
    {
        return $this->upload==null ? 'Tidak Ada File' : asset('images/pegawai').'/'.$this->users_id.'/dokument/'.$this->upload;
    }


}
