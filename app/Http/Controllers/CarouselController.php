<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Pengumuman;
use App\Outst_employee;
use App\Outstation;
use App\Outst_destiny;
use App\Vehiclerent;

class CarouselController extends Controller
{
    public function index()
    {
        $today = Carbon::now();
        // $week = Carbon::now()->subDays(7); // untuk 7 hari ke belakang
        $week = Carbon::now()->addDays(7); // untuk 7 hari ke depan
        $annc = Pengumuman::
                whereRaw("curdate() BETWEEN dari AND sampai")
                ->first();
        $one = Vehiclerent::SelectRaw('users_id, car_id, date_from, date_to, driver_id, destination')
                ->where('status','=','Y')
                ->whereRaw("curdate() BETWEEN date_from AND date_to");
        $two = Vehiclerent::SelectRaw('users_id, car_id, date_from, date_to, driver_id, destination')
                ->where('status','=','Y')
                ->whereRaw("curdate()+1 BETWEEN date_from AND date_to");
        $three =Vehiclerent::SelectRaw('users_id, car_id, date_from, date_to, driver_id, destination')
                ->where('status','=','Y')
                ->whereRaw("curdate()+2 BETWEEN date_from AND date_to");
        $four = Vehiclerent::SelectRaw('users_id, car_id, date_from, date_to, driver_id, destination')
                ->where('status','=','Y')
                ->whereRaw("curdate()+3 BETWEEN date_from AND date_to");
        $mobil = Vehiclerent::SelectRaw('users_id, car_id, date_from, date_to, driver_id, destination')
                ->where('status','=','Y')
                ->whereRaw("curdate()+4 BETWEEN date_from AND date_to")
                ->union($one)
                ->union($two)
                ->union($three)
                ->union($four)
                ->get();

        $satu = Outstation::SelectRaw('DISTINCT (outstation.id), number, purpose, transport, type')
                            ->LeftJoin('outst_destiny','outst_destiny.outstation_id','=','outstation.id')
                            ->whereRaw("curdate() BETWEEN go_date AND return_date");
        $dua = Outstation::SelectRaw('DISTINCT (outstation.id), number, purpose, transport, type')
                            ->LeftJoin('outst_destiny','outst_destiny.outstation_id','=','outstation.id')
                            ->whereRaw("curdate()+1 BETWEEN go_date AND return_date");
        $tiga =Outstation::SelectRaw('DISTINCT (outstation.id), number, purpose, transport, type')
                            ->LeftJoin('outst_destiny','outst_destiny.outstation_id','=','outstation.id')
                            ->whereRaw("curdate()+2 BETWEEN go_date AND return_date");
        $empat = Outstation::SelectRaw('DISTINCT (outstation.id), number, purpose, transport, type')
                            ->LeftJoin('outst_destiny','outst_destiny.outstation_id','=','outstation.id')
                            ->whereRaw("curdate()+3 BETWEEN go_date AND return_date");
        $perjadin = Outstation::SelectRaw('DISTINCT (outstation.id), number, purpose, transport, type')
                ->LeftJoin('outst_destiny','outst_destiny.outstation_id','=','outstation.id')
                ->whereRaw("curdate()+4 BETWEEN go_date AND return_date")
                ->union($satu)
                ->union($dua)
                ->union($tiga)
                ->union($empat)
                ->get();
        
        
        return view('carousel.index',compact('annc','mobil','perjadin'));
    }
}
