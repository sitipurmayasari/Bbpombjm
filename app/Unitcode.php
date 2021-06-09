<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unitcode extends Model
{
    protected $table = "unitcode";
    protected $fillable = ['klcode_id','code','name'];

    public function klcode()
    {
        return $this->belongsTo(Klcode::class,'klcode_id','id');
    }

}
