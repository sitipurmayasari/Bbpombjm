<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travelexpenses extends Model
{
    protected $table = "travelexpenses";
    protected $fillable = ['expenses_id','outst_employee_id',
                            'dailywage','hitdaily','jumdaily','totdaily',
                            'diklat','hitdiklat','jumdiklat','totdiklat',
                            'fullboard','hitfullb','jumfullb','totfullb',
                            'fullday','hithalf','jumhalf','tothalf',
                            'representatif','hitrep','jumrep','totrep',
                            'dayshalf','feehalf','totdayshalf',
                            'daysfull','feefull','totdaysfull'
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
