<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stbook extends Model
{
    protected $table = "stbook";
    protected $fillable = ['divisi_id','stbook_date','stbook_number'
                        ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class,'divisi_id','id');
    }

}
