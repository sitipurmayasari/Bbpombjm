<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Pelatihan;


class DashboardController extends Controller
{
    public function index()
    {
        $peg =auth()->user()->id;
        $jumpeg = User::selectRaw(" COUNT(*) AS total ")
                ->where('aktif','Y')
                ->first();
        $datapeg = User::selectRaw(" status, COUNT(*) AS jumlah ")
                ->where('aktif','Y')
                ->groupByRaw('status')
                ->get();

        $latih = Pelatihan::selectRaw("sum(lama) AS waktu")
                            ->where('users_id',$peg)
                             ->WhereRaw("YEAR(dari) = YEAR(CURDATE())")
                            ->first();
        
        return view('amdk/dashboard.index',compact('jumpeg', 'datapeg','latih'));
    }

   
}
