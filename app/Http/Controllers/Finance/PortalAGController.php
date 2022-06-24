<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Pengumuman;
use App\Agenda;
use App\Vehiclerent;
use App\UserPermission;

class PortalAGController extends Controller
{
    public function index()
    {
        $peg =auth()->user()->id;
        $data = Pengumuman::
                whereRaw("curdate() BETWEEN dari AND sampai")
                ->first();
        $tgl = Carbon::now()->day;
        $bulan = Carbon::now()->isoFormat('MMMM');
        $tahun = Carbon::now()->year;
        $hari = Carbon::now()->isoFormat('dddd');
        $keterangan = Agenda::WhereRaw('CURDATE() BETWEEN date_from AND date_to')->get();
        $aksespinjam = UserPermission::where('menu_id','59')->where('user_id',$peg)->first();
        $pinjam = Vehiclerent::WhereRaw('status is null')->first();
        $aju = Vehiclerent::where('users_id', $peg)
                            ->WhereRaw('status IS NOT NULL AND updated_at >= NOW() - INTERVAL 1 DAY')->first();
                
        return view('finance/portalAG',compact('data','tgl','bulan','tahun','hari','keterangan','pinjam','aksespinjam','aju'));
    }

}
