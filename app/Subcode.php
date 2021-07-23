<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcode extends Model
{
    protected $table = "subcode";
    protected $fillable = ['komponencode_id','code','name','kodeall'];

    public function komponen()
    {
        return $this->belongsTo(Komponencode::class,'komponencode_id','id');
    }
}
