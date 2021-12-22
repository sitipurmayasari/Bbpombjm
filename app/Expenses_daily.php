<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses_daily extends Model
{
    protected $table = "expenses_daily";
    protected $fillable = ['expenses_id','outst_employee_id',
                            'dailywage1','hitdaily1','jumdaily1','totdaily1',
                            'dailywage2','hitdaily2','jumdaily2','totdaily2',
                            'dailywage3','hitdaily3','jumdaily3','totdaily3',
];

    public function peg()
    {
        return $this->belongsTo(Outst_employee::class,'outst_employee_id','id');
    }


}
