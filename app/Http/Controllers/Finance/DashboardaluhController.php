<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Linkaluh;

class DashboardaluhController extends Controller
{
    public function index()
    {
        $data = Linkaluh::orderBy('name','asc')
                                ->where('aktif','Y')
                                ->get();
        return view('finance/dashboardaluh.index',compact('data'));
    }
}
