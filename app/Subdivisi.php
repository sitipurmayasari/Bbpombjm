<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdivisi extends Model
{
    protected $table = "subdivisi";
    protected $fillable = ["divisi_id","nama_subdiv"];

    public function kelompok()
    {
        return $this->belongsTo(Divisi::class,'divisi_id','id');
    }
}