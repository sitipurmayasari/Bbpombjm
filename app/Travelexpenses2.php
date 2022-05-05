<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travelexpenses2 extends Model
{
    protected $table = "travelexpenses2";
    protected $fillable = ['expenses_id','outst_employee_id',
                            'inn_loc1','inn_telp1','checkin1','checkout1','inn_room1','innvoice1','inap1','hotelmax1','hotelkkp1',
                            'inn_loc2','inn_telp2','checkin2','checkout2','inn_room2','innvoice2','inap2','hotelmax2','hotelkkp2',
                            'plane_book1','plane_flight1','planekkp1',
                            'plane_book2','plane_flight2','planekkp2',
                            'plane_book3','plane_flight3','planekkp3',
                            'plane_bookreturn','plane_flightreturn','planekkpreturn'
    ];

    public function peg()
    {
        return $this->belongsTo(User::class,'employee_id','id');
    }
}
