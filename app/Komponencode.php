<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komponencode extends Model
{
    protected $table = "komponencode";
    protected $fillable = ['code','name','detailcode_id'];

    public function det()
    {
        return $this->belongsTo(Detailcode::class,'detailcode_id','id');
    }

}
