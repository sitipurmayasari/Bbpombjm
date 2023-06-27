<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terkait extends Model
{
    protected $table = "terkait";
    protected $fillable = ["name","link","icon","lokasi","aktif"
                        ];

    public function getFoto() 
    {
        return $this->icon==null ? asset('images/user/barang.png') : asset('images/terkait').'/'.$this->icon;
    }
}
