<?php

namespace App\Http\Controllers\Invent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\User;
use App\Aduan;
use App\JadwalMain;
use App\Maintenance;
use App\Car;
use App\Vehiclerent;
use App\Pengajuan;
use App\PengajuanDetail;



class DashboardController extends Controller
{
    public function index()
    {
        $peg =auth()->user()->id;
        $now = Carbon::now()->month;
        $jadwal = JadwalMain::orderBy('id','desc')
                        ->whereMonth('tanggal',date('m'))    
                        ->paginate('5');
        $aduan  = Aduan::selectRaw("MONTH(tanggal) AS bulan, COUNT(*) AS jumlah ")
                        ->WhereRaw("YEAR(tanggal) = YEAR(CURDATE())")
                        ->groupByRaw('MONTH(tanggal)')
                        ->get();
        $car    = Car::orderBy('id','desc')
                        ->whereMonth('tax_date',date('m'))    
                        ->paginate('5');
        $dinas  = Vehiclerent::orderBy('id','desc')
                        ->where('users_id',$peg)
                        ->first();
        $tglaju = Pengajuan::orderBy('id','desc')
                        ->where('pegawai_id',$peg)
                        ->first();
        if ($tglaju !=null) {
                    $aju    =  PengajuanDetail::orderBy('id','asc')
                    ->where('pengajuan_id',$tglaju->id)
                    ->get();

            return view('invent/dashboard.index',compact('jadwal','aduan','car','dinas','tglaju','aju'));
        }else{
            return view('invent/dashboard.index',compact('jadwal','aduan','car','dinas','tglaju'));
        }
        
        
    }
}
