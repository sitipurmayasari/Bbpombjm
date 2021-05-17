<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    protected $table = "submenu";
    protected $fillable = ["menu_id","nama","link"];

    public function menu()
    {
        return $this->belongsTo(Menu::class,'menu_id','id');
    }
}