<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesInap extends Model
{
    protected $table = "expensesinap";
    protected $fillable = ['expenses_id','outst_employee_id','hotelkkp','rillhotel','hotelname','hoteladdr','hoteltelp','hotelroom',
                            'hotelin','hotelout','hotelfee','hotellong','person','hotelsum','hotelinfo','hotelpersen','hotelmax'
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
