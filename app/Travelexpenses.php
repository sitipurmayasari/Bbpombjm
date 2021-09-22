<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travelexpenses extends Model
{
    protected $table = "travelexpenses";
    protected $fillable = ['expenses_id','outst_employee_id','transport','dailywage','diklat','fullboard','fullday','representatif',
                            'innname_1','inn_fee_1','long_stay_1','klaim_1','innname_2','inn_fee_2','long_stay_2','klaim_2',
                            'plane_id','planego','godate','returndate','planereturn','bbm','taxy_count_from','taxy_fee_from',
                            'taxy_count_to','taxy_fee_to'
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
