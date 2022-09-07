<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planlab_detail extends Model
{
    protected $table = "planlab_detail";
    protected $fillable = ["planlab_id","names","katalog","kemasan", "jumlah","satuan_id","file_foto","setuju"];
    
    public function satuan() 
    {
        return $this->belongsTo(Satuan::class);
    }

    public function getFoto() 
    {
        return $this->file_foto==null ? asset('images/user/barang.png') : asset('images/planlab').'/'.$this->id.'/'.$this->file_foto;
    }


}
