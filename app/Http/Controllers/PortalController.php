<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Pengumuman;
use App\Agenda;
use App\Vehiclerent;
use App\UserPermission;

class PortalController extends Controller
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
        $aju = Vehiclerent::WhereRaw('status IS NOT NULL AND created_at >= NOW() - INTERVAL 2 DAY')->first();
                
        return view('portal',compact('data','tgl','bulan','tahun','hari','keterangan','pinjam','aksespinjam','aju'));
    }
}
