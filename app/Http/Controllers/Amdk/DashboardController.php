<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Pelatihan;
use App\Absensi;


class DashboardController extends Controller
{
    public function index()
    {
        $peg =auth()->user()->id;
        $now = Carbon::now()->month;
        $jumpeg = User::selectRaw(" COUNT(*) AS total ")
                ->where('aktif','Y')
                ->where('id','!=','1')
                ->first();
        $datapeg = User::selectRaw(" status, COUNT(*) AS jumlah ")
                ->where('aktif','Y')
                ->where('id','!=','1')
                ->groupByRaw('status')
                ->get();

        $latih = Pelatihan::selectRaw("sum(lama) AS waktu")
                            ->where('users_id',$peg)
                            ->WhereRaw("YEAR(dari) = YEAR(CURDATE())")
                            ->first();
        
        $lastm = Carbon::now()->subMonth()->month;
        $lastY = Carbon::now()->subYear()->year;

        $nowbln = (Carbon::now()->month);
        $nowthn = (Carbon::now()->year);

        $poinabsen = Absensi::selectRaw("SUM(poin) AS jumpoin, periode_month, periode_year")
                            ->where('users_id',$peg)
                            ->where('periode_month','!=',$nowbln)
                            ->groupByRaw('periode_month,periode_year')
                            ->limit('5')
                            ->get();
        
        return view('amdk/dashboard.index',compact('jumpeg', 'datapeg','latih','poinabsen'));
    }

   
}
