<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archives extends Model

{
    use SoftDeletes;
    protected $table = "archives";
    protected $fillable = ['divisi_id','users_id','mailclasification_id','uraian','tingkat','date','kualifikasi','jumlah',
                            'file'
                        ];
    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->belongsTo(Users::class,'users_id','id');
    }
    public function div()
    {
        return $this->belongsTo(Divisi::class,'divisi_id','id');
    }
    public function klas()
    {
        return $this->belongsTo(Mailclasification::class,'mailclasification_id','id');
    }
    // public function outst_destiny()
    // {
    //     return $this->hasMany(Outst_destiny::class,'outstation_id','id');
    // }
    public function getFIlearsip() 
    {
        return $this->file==null ? 'Tidak Ada File' : asset('images/arsiparis').'/'.$this->id.'/'.$this->file;
    }

}
