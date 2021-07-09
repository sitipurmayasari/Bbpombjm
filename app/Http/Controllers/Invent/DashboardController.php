<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Aduan;
use App\JadwalMain;
use App\Maintenance;
use App\Car;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now()->month;
        $jadwal = JadwalMain::orderBy('id','desc')
                ->whereMonth('tanggal',date('m'))    
                ->paginate('5');
        $aduan = Aduan::
                selectRaw("MONTH(tanggal) AS bulan, COUNT(*) AS jumlah ")
                ->WhereRaw("YEAR(tanggal) = YEAR(CURDATE())")
                ->groupByRaw('MONTH(tanggal)')
                ->get();
        $car = Car::orderBy('id','desc')
                ->whereMonth('tax_date',date('m'))    
                ->paginate('5');

        
        return view('invent/dashboard.index',compact('jadwal','aduan','car'));
    }
}
