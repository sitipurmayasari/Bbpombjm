<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    protected $table = "monitor";
    protected $fillable = ['number','kode','dates', 'bakteri_id','users_id','media_date','baku_date','tumbuh_date',
                            'media_ket','baku_ket','tumbuh_ket','hasil','kesimpulan'
    ];

    
    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function bakteri()
    {
        return $this->belongsTo(Bakteri::class,'bakteri_id','id');
    }

}
