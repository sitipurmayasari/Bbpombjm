<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Linkkulihanku;

class DashboardkuController extends Controller
{
    public function index()
    {
        $data = Linkkulihanku::orderBy('id','desc')
                                ->where('aktif','Y')
                                ->get();
        return view('finance/dashboardku.index',compact('data'));
    }
}
