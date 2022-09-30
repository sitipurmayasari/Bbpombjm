<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesUh extends Model
{
    protected $table = "expensesuh";
    protected $fillable = ['expenses_id','outst_employee_id','tlokalcost','tlokalkali','tlokalsum','uhar1cost','uhar1kali','uhar1sum',
                            'uhar2cost','uhar2kali','uhar2sum','uhar3cost','uhar3kali','uhar3sum','diklatcost','diklatkali','diklatsum',
                            'fullboardcost','fullboardkali','fullboardsum','fulldaycost','fulldaykali','fulldaysum',
                            'repscost','repskali','repssum','halflong','halfcost','halfsum','fulllong','fullcost','fullsum'
                        ];

    public function expenses()
    {
        return $this->belongsTo(Expenses::class,'expenses_id','id');
    }

    public function peg()
    {
        return $this->belongsTo(Outst_employee::class,'expenses_id','id');
    }


}
