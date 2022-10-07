<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesTrans extends Model
{
    protected $table = "expensestrans";
    protected $fillable = ['expenses_id','outst_employee_id', 'rilltaxi','taxitype','taxifee','taxicount','taxisum','taxiname'
                        ];

    public function expenses()
    {
        return $this->belongsTo(Expenses::class,'expenses_id','id');
    }

    public function peg()
    {
        return $this->belongsTo(Outst_employee::class,'outst_employee_id','id');
    }


}
