<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travelexpenses1 extends Model
{
    protected $table = "travelexpenses1";
    protected $fillable = ['expenses_id','outst_employee_id',
                            'innname_1','inn_fee_1','long_stay_1','isi_1','klaim_1',
                            'innname_2','inn_fee_2','long_stay_2','isi_2','klaim_2',
                            'bbm','taxy_count_from','taxy_fee_from','taxy_count_to','taxy_fee_to',
                            'plane_id1','planenumber1','planefee1','godate1',
                            'plane_id2','planenumber2','planefee2','godate2',
                            'plane_id3','planenumber3','planefee3','godate3',
                            'plane_idreturn','planenumberreturn','planereturnfee','returndate'
];

    public function peg()
    {
        return $this->belongsTo(Outst_employee::class,'outst_employee_id','id');
    }

    public function plane1()
    {
        return $this->belongsTo(Plane::class,'plane_id1','id');
    }
    public function plane2()
    {
        return $this->belongsTo(Plane::class,'plane_id2','id');
    }
    public function plane3()
    {
        return $this->belongsTo(Plane::class,'plane_id3','id');
    }
    public function planeret()
    {
        return $this->belongsTo(Plane::class,'plane_idreturn','id');
    }
}
