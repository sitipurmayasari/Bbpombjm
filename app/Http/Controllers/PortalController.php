<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Pengumuman;
use App\Agenda;
use App\Vehiclerent;
use App\UserPermission;
use App\Terkait;
use App\User;

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
        $aju = Vehiclerent::where('users_id', $peg)
                            ->WhereRaw('status IS NOT NULL AND updated_at >= NOW() - INTERVAL 1 DAY')->first();
        $terkait = Terkait::where('lokasi','!=','2')->get();

        $pop =  User::where('id', $peg)
                    ->WhereRaw('updated_at >= DATE(NOW() - INTERVAL 6 MONTH)')
                    ->first();  
        return view('portal',compact('data','tgl','bulan','tahun','hari','keterangan','pinjam','aksespinjam','aju','terkait','pop'));
    }
}
