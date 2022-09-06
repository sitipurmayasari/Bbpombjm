<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BakteriDetail extends Model
{
    protected $table = "bakteri_detail";
    protected $fillable = ['bakteri_id','media_id'
];

    public function bakteri()
    {
        return $this->belongsTo(Bakteri::class,'bakteri_id','id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class,'media_id','id');
    }

}
