<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Aduan;
use App\JadwalMain;
use App\Maintenance;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $jadwal = JadwalMain::orderBy('id','desc')->paginate('10');
        $aduan = Aduan::
                selectRaw(" MONTH(tanggal) AS bulan, COUNT(*) AS jumlah ")
                ->WhereRaw("YEAR(tanggal) = YEAR(CURDATE())")
                ->groupByRaw('MONTH(tanggal)')
                ->get();

        $maintenance = Maintenance::whereMonth('tgl_pelihara',date('m'))->get();
        
        return view('invent/dashboard.index',compact('jadwal','maintenance','aduan'));
    }
}
