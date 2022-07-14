<?php

namespace App\Http\Controllers\Arsip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Archives;
class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now()->month;
        $peg = auth()->user()->id;
        $arsip  = Archives::selectRaw("MONTH(date) AS bulan, COUNT(*) AS total ")
                            ->WhereRaw("YEAR(date) = YEAR(CURDATE())")
                            ->groupByRaw('MONTH(date)')
                            ->get();

        $jumlah = Archives:: SelectRaw('mailgroup.alias , COUNT(*) AS total')
                            ->LeftJoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                            ->LeftJoin('mailsubgroup','mailsubgroup.id','mailclasification.mailsubgroup_id')
                            ->leftjoin('mailgroup','mailgroup.id','mailsubgroup.mailgroup_id')
                            ->whereraw('YEAR(date) = YEAR(CURDATE())')
                            ->where('archives.users_id',$peg)
                            ->groupby('mailgroup.alias')
                            ->get();
        return view('arsip/dashboard.index',compact('now','arsip','jumlah'));
    }
}
