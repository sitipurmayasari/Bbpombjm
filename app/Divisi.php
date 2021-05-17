<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = "divisi";
    protected $fillable = ["nama","sub_kelompok","lokasi"];

    public function lokasi()
    {
        return $this->hasManyThrough(Aduan::class, Inventaris::class);
    }
}
