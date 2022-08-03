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


class DashboardNapzaController extends Controller
{
    public function index()
    {
        $peg =auth()->user()->id;
        $tgl = Carbon::now()->day;
        $bulan = Carbon::now()->isoFormat('MMMM');
        $tahun = Carbon::now()->year;
        $hari = Carbon::now()->isoFormat('dddd');
        $dataglass = Inventaris::selectRaw(" jenis_barang, COUNT(*) AS jumlah ")
                        ->whereraw('jenis_barang in (3,21)')
                        ->groupByRaw('jenis_barang')
                        ->get();
        
        return view('calibration/dashboardnapza.index',compact('dataglass','tahun'));
    }
}
