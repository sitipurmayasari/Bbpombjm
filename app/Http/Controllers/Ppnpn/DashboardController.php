<?php

namespace App\Http\Controllers\Ppnpn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Absensi;

class DashboardController extends Controller
{
    public function index()
    {
        $peg =auth()->user()->id;
        $now = Carbon::now()->month;
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

        return view('ppnpn/dashboard.index',compact('now','poinabsen'));
    }

}
