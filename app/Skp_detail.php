<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skp_detail extends Model
{
    protected $table = "skp_detail";
    protected $fillable = ['skp_id','setup_ak_id','n_ak','tot_ak','quan','jen','kual','time','cost'
                        ];

    public function skp()
    {
        return $this->belongsTo(Skp::class,'skp_id','id');
    }

    public function keg()
    {
        return $this->belongsTo(Setup_ak::class,'setup_ak_id','id');
    }

}
