<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    protected $table = "evaluasi";
    protected $fillable = ['date','pelatihan_id','total','coment'
                            ];

    public function pelatihan()
    {
        return $this->belongsTo(User::class,'pelatihan_id','id');
    }
    
}