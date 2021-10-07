<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travelexpenses extends Model
{
    protected $table = "travelexpenses";
    protected $fillable = ['expenses_id','outst_employee_id','dailywage','diklat','fullboard','fullday','representatif',
                            'hitdaily','hittrans','hitdiklat','hitfullb','hithalf','hitrep'
];

    public function peg()
    {
        return $this->belongsTo(Outst_employee::class,'outst_employee_id','id');
    }

    public function plane()
    {
        return $this->belongsTo(Plane::class,'plane_id','id');
    }
}
