<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realrapk_detail extends Model
{
    protected $table = "realrapk_detail";
    protected $fillable = ['eselontwo_id','indicator_id','realisasi','realrapk_id'];

    public function rapk()
    {
        return $this->belongsTo(Realrapk::class,'realrapk_id','id');
    }

    public function eselon()
    {
        return $this->belongsTo(Eselontwo::class,'eselontwo_id','id');
    }
    

    public function indi()
    {
        return $this->belongsTo(Indicator::class,'indicator_id','id');
    }
}
