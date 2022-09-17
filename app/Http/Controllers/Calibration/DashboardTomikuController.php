<?php

namespace App\Http\Controllers\Calibration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Agenda;
use App\Vehiclerent;
use App\UserPermission;
use App\Inventaris;
use App\Monitor;


class DashboardTomikuController extends Controller
{
    public function index()
    {
        $peg =auth()->user()->id;
        $tgl = Carbon::now()->day;
        $bulan = Carbon::now()->isoFormat('MMMM');
        $tahun = Carbon::now()->year;
        $hari = Carbon::now()->isoFormat('dddd');

        $monitor  = Monitor::selectRaw("MONTH(dates) AS bulan, COUNT(*) AS total ")
                            ->WhereRaw("YEAR(dates) = YEAR(CURDATE())")
                            ->groupByRaw('MONTH(dates)')
                            ->get();
        
        return view('calibration/dashboardtomiku.index',compact('monitor'));
    }
}
