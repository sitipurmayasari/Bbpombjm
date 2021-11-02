<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagu extends Model
{
    protected $table = "pagu";
    protected $fillable = ["users_id","year","name","month"];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

  
}