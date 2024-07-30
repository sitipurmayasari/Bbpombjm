<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    protected $table = "disposisi";
    protected $fillable = ['tanggal','no_agenda','no_surat','tgl_surat','pengirim','hal','divisi_id','keterangan','file'
];

    public function div()
    {
        return $this->belongsTo(Divisi::class,'divisi_id','id');
    }

    public function getfileDispo() 
    {
        return $this->file==null ? 'Tidak Ada File' : asset('images/arsiparis/disposisi').'/'.$this->id.'/'.$this->file;
    }


}
