<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stbook_sppd extends Model
{
    protected $table = "stbook_sppd";
    protected $fillable = ['stbook_id','nomor_sppd'
                        ];

    public function stbook()
    {
        return $this->belongsTo(Stbook::class,'stbook_id','id');
    }

}
