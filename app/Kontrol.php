<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontrol extends Model
{
    protected $table = "kontrol";
    protected $fillable = ['media_id','status','default'
];

    public function media()
    {
        return $this->belongsTo(Media::class,'media_id','id');
    }

}
