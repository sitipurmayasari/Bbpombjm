<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pok_detail extends Model
{
    protected $table = "pok_detail";
    protected $fillable = ['pok_id','krocode_id','detailcode_id','komponencode_id','subcode_id','accountcode_id',
                            'loka_id','volume','price','total','sd','realisasi','sisa','detail'
    ];

    public function pok()
    {
        return $this->belongsTo(Pok::class,'pok_id','id');
    }

    public function kro()
    {
        return $this->belongsTo(Krocode::class,'krocode_id','id');
    }

    public function det()
    {
        return $this->belongsTo(Detailcode::class,'detailcode_id','id');
    }

    public function komponen()
    {
        return $this->belongsTo(Komponencode::class,'komponencode_id','id');
    }

    public function akun()
    {
        return $this->belongsTo(Accountcode::class,'accountcode_id','id');
    }

    public function loka()
    {
        return $this->belongsTo(Loka::class,'loka_id','id');
    }

    public function sub()
    {
        return $this->belongsTo(Subcode::class,'subcode_id','id');
    }

}
