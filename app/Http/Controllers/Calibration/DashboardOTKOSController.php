<?php

namespace App\Http\Controllers\Calibration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\UserPermission;


class DashboardOTKOSController extends Controller
{
    public function index()
    {
        $peg =auth()->user()->id;
        $tgl = Carbon::now()->day;
        
        return view('calibration/comingsoon');
    }
}
