<?php

namespace App\Http\Controllers\Qms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Pengumuman;
use App\Agenda;
use App\Vehiclerent;
use App\UserPermission;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now()->month;

        return view('qms/dashboard.index',compact('now'));
    }

}
