<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dupak extends Model
{
    protected $table = "dupak";
    protected $fillable = ['users_id','nomor_kp','tanggal','dari','sampai','masa_lama_thn','masa_lama_bln',
                            'masa_baru_thn','masa_baru_bln','promoted','golongan_id','tmtusul','tmtlama','reset','startpoin',
                            'file','sa1','sa2','sb','sc','jum1','da','jumlah','jumlama','total','seri_karpeg','tmt','jabasn_id',
                            'tmtjabbaru','rapel'
];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function gol()
    {
        return $this->belongsTo(Golongan::class,'golongan_id','id');
    }

    public function jabasn()
    {
        return $this->belongsTo(Jabasn::class,'jabasn_id','id');
    }

    public function ripend()
    {
        return $this->belongsTo(RiwayatPend::class,'users_id','users_id');
    }

    public function getFIleDupak() 
    {
        return $this->file==null ? 'Tidak Ada File' : asset('images/pegawai').'/'.$this->users_id.'/dupak/'.$this->file;
    }


}
