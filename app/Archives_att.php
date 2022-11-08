<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archives_att extends Model

{
    protected $table = "archives";
    protected $fillable = ['archives_id','attachfile'
                        ];

    public function arsip()
    {
        return $this->belongsTo(Archives::class,'archives_id','id');
    }


}
