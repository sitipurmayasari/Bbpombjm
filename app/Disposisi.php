<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    protected $table = "disposisi";
    protected $fillable = ['tanggal','no_agenda','no_surat','tgl_surat','pengirim','hal','divisi_id','keterangan','fileDispo'
];

    public function div()
    {
        return $this->belongsTo(Divisi::class,'divisi_id','id');
    }

    public function getfileDispo() 
    {
        return $this->fileDispo==null ? 'Tidak Ada File' : asset('images/arsiparis/disposisi').'/'.$this->id.'/'.$this->fileDispo;
    }


}
