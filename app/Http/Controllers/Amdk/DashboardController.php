<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;


class DashboardController extends Controller
{
    public function index()
    {
        $jumpeg = User::selectRaw(" COUNT(*) AS total ")
                ->where('aktif','Y')
                ->first();
        $datapeg = User::selectRaw(" status, COUNT(*) AS jumlah ")
                ->where('aktif','Y')
                ->groupByRaw('status')
                ->get();
        return view('amdk/dashboard.index',compact('jumpeg', 'datapeg'));
    }

   
}
