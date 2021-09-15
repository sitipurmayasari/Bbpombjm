<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    protected $table = "pelatihan";
    protected $fillable = ['users_id','jenis','nama','dari','sampai','lama','file','penyelenggara','terekam'
                            ];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function getFIleSert() 
    {
        return $this->file==null ? 'Tidak Ada File' : asset('images/pegawai').'/'.$this->users_id.'/sertifikat/'.$this->file;
    }

    
}