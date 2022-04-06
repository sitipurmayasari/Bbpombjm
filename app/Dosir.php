<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosir extends Model
{
    protected $table = "dosir";
    protected $fillable = ['users_id','nama','file','archive_time_id','divisi_id'
];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function arsip()
    {
        return $this->belongsTo(Archive_time::class,'archive_time_id','id');
    }

    public function div()
    {
        return $this->belongsTo(Divisi::class,'divisi_id','id');
    }

    public function getFIledosir() 
    {
        return $this->file==null ? 'Tidak Ada File' : asset('images/pegawai').'/'.$this->users_id.'/dosir/'.$this->file;
    }


}
