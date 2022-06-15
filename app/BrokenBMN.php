<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrokenBMN extends Model
{
    protected $table = "brokenbmn";
    protected $fillable = ['users_id','nomor','tanggal','divisi_id'];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function div()
    {
        return $this->belongsTo(Divisi::class,'divisi_id','id');
    }

}
