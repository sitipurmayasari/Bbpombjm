<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menu";
    protected $fillable = ["nama","link"];

    public function sub()
    {
        return $this->belongsTo(Submenu::class,'id','menu_id');
    }

}