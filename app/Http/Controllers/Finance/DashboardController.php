<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Outstation;
use App\Pok;

class DashboardController extends Controller
{
    public function index()
    {
        $dinas  = Outstation::selectRaw("MONTH(st_date) AS bulan, COUNT(*) AS total ")
                            ->WhereRaw("YEAR(st_date) = YEAR(CURDATE())")
                            ->groupByRaw('MONTH(st_date)')
                            ->get();
        $jumst  = Outstation::selectRaw("COUNT(*) AS total ")
                            ->WhereRaw("YEAR(st_date) = YEAR(CURDATE())")
                            ->first();
        $act1   = Pok::OrderBy('id','desc')
                        ->LeftJoin(DB::raw("(SELECT pok_id, SUM(total) AS total, SUM(sisa) AS sisa FROM pok_detail GROUP BY pok_id) isi"),
                                    'isi.pok_id','=','pok.id')
                        ->Where('activitycode_id','=','3')
                        ->WhereRaw('pok.year = YEAR(CURDATE())')
                        ->first();
        $act2   = Pok::OrderBy('id','desc')
                        ->LeftJoin(DB::raw("(SELECT pok_id, SUM(total) AS total, SUM(sisa) AS sisa FROM pok_detail GROUP BY pok_id) isi"),
                                    'isi.pok_id','=','pok.id')
                        ->Where('activitycode_id','=','2')
                        ->WhereRaw('pok.year = YEAR(CURDATE())')
                        ->first();

        $tot    = $act1->total + $act2->total;
        $sisa   = $act1->sisa + $act2->sisa;

        return view('finance/dashboard.index',compact('dinas','jumst','act1','act2','tot','sisa'));
    }
}
