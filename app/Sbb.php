<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sbb extends Model
{
    protected $table = "sbb";
    protected $fillable = ['users_id','nomor','tanggal','jenis','stat_aduan','labory_id'
];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }



}
