<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TukinDetail extends Model
{
    protected $table = "tukin_detail";
    protected $fillable = ['tukin_id','users_id','nilai','potongan','terima','potonganRp'
    ];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function tukin()
    {
        return $this->belongsTo(Tukin::class,'tukin_id','id');
    }


}
