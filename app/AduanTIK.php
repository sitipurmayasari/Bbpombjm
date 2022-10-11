<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AduanTIK extends Model
{
    protected $table = "aduantik";
    protected $fillable = ['no_aduan','tanggal','users_id','itasset_id','trouble','follow_up','result',
                            'analyze_date','status','divisi_id'];

    public function barang()
    {
        return $this->belongsTo(ItAsset::class,'itasset_id','id');
    }

    public function lapor()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
    public function divisi()
    {
        return $this->belongsTo(Divisi::class,'divisi_id','id');
    }

}
