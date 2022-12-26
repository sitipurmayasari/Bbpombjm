<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sbb extends Model
{
    protected $table = "sbb";
    protected $fillable = ['users_id','nomor','tanggal','jenis','stat_aduan','labory_id','pejabat_id','file', 'tgl_terima'
];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function mengetahui()
    {
        return $this->belongsTo(Pejabat::class,'pejabat_id','id');
    }

    public function labory()
    {
        return $this->belongsTo(Labory::class,'labory_id','id');
    }

    public function isi()
    {
        return $this->hasMany(Sbbdetail::class,'sbb_id','id');
    }

    public function getFIleSbb() 
    {
        return $this->file==null ? 'Tidak Ada File' : asset('images/SBB').'/'.$this->id.'/'.$this->file;
    }



}
