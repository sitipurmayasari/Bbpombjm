<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Pengumuman;
use App\Agenda;

class PortalController extends Controller
{
    public function index()
    {
        $data = Pengumuman::
                whereRaw("curdate() BETWEEN dari AND sampai")
                ->first();
        $tgl = Carbon::now()->day;
        $bulan = Carbon::now()->isoFormat('MMMM');
        $tahun = Carbon::now()->year;
        $hari = Carbon::now()->isoFormat('dddd');
        $keterangan = Agenda::WhereRaw('CURDATE() BETWEEN date_from AND date_to')->get();
                
        return view('portal',compact('data','tgl','bulan','tahun','hari','keterangan'));
    }
}
