<?php

namespace App\Http\Controllers\Calibration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;



class DashboardController extends Controller
{
    public function index()
    {
        $peg =auth()->user()->id;
        $now = Carbon::now()->month;

        return view('calibration/dashboard.index',compact('peg','now'));
    }
}
