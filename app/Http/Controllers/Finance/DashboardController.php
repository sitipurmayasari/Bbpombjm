<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Outstation;

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
        return view('finance/dashboard.index',compact('dinas','jumst'));
    }
}
