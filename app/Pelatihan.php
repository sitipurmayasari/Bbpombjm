<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    protected $table = "pelatihan";
    protected $fillable = ['users_id','jenis_pelatihan_id','nama','dari','sampai','lama','file','penyelenggara','terekam','deskripsi','evaluasi',
                            'evaluator_id','jabasn_id','ketua'
                            ];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis_pelatihan::class,'jenis_pelatihan_id','id');
    }

    public function getFIleSert() 
    {
        return $this->file==null ? 'Tidak Ada File' : asset('images/pegawai').'/'.$this->users_id.'/sertifikat/'.$this->file;
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class,'evaluator_id','id');
    }

    public function jabasn()
    {
        return $this->belongsTo(Jabasn::class,'jabasn_id','id');
    }

    
}