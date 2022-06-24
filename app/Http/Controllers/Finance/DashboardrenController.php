<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Outstation;
use App\Pok;

class DashboardrenController extends Controller
{
    public function index()
    {
        return view('finance/dashboardren.index');
    }
}
