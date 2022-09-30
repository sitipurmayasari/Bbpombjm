<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesPlane extends Model
{
    protected $table = "expensesplane";
    protected $fillable = ['expenses_id','outst_employee_id', 'planekkp','ticketnumber','ticketfee','ticketdate',
                            'bookingcode','flightnumber','plane_id'
                        ];

    public function expenses()
    {
        return $this->belongsTo(Expenses::class,'expenses_id','id');
    }

    public function peg()
    {
        return $this->belongsTo(Outst_employee::class,'expenses_id','id');
    }

    public function plane()
    {
        return $this->belongsTo(Plane::class,'plane_id','id');
    }


}
