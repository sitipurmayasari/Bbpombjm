<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    protected $table = "realisasi";
    protected $fillable = ['number','users_id','pok_detail_id','keterangan','asalpok',
    'activitycode_id','subcode_id','accountcode_id','loka_id'];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function pokdetail()
    {
        return $this->belongsTo(Pok_detail::class,'pok_detail_id','id');
    }

}
