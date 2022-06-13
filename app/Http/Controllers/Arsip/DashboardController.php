<?php

namespace App\Http\Controllers\Arsip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now()->month;

        return view('arsip/dashboard.index',compact('now'));
    }
}
