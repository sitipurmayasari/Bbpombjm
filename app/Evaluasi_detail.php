<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluasi_detail extends Model
{
    protected $table = "evaluasi_detail";
    protected $fillable = ['evaluasi_id','aspek_evaluasi','point'
                            ];

    public function Evaluasi()
    {
        return $this->belongsTo(User::class,'evaluasi_id','id');
    }
    
}