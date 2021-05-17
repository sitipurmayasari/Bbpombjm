<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokpeg extends Model
{
    protected $table = "dok_kepegawaian";
    protected $fillable = ['users_id','jendok_id','nomor','upload','tanggal','keterangan','tmt'
];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

}
