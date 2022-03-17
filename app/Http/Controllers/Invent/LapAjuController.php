<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Aduan;
use App\Inventaris;
use App\Pengajuan;
use App\PengajuanDetail;
use App\Satuan;

use PDF;
class LapAjuController extends Controller
{
    public function index()
    {
        return view('invent/lapajuan.index');
    }
    public function cetak(Request $request)
    {
        if($request->jenis_Laporan=="baru"){
            $user   = User::all();
            $data   = Pengajuan::orderBy('id','asc')
                                ->whereYear('tgl_ajuan',$request->daftartahun)
                                ->when($request->daftarbulan, function ($query) use ($request) {
                                    $query->whereMonth('tgl_ajuan',$request->daftarbulan);
                                 })
                                 ->when($request->piltgl, function ($query) use ($request) {
                                    if($request->piltgl==2){
                                        $query->WhereRaw('tgl_ajuan between "'.$request->awal.'" AND "'.$request->akhir.'"');
                                    }
                                 })
                                ->get();
            $pdf = PDF::loadview('invent/lapajuan.ajuan',compact('user','data','request'));
            return $pdf->stream();

        }else if($request->jenis_Laporan=="rusak"){
            $user   = User::all();
            $data   = Aduan::orderBy('id','desc')
                                ->whereYear('tanggal',$request->daftartahun)
                                ->when($request->daftarbulan, function ($query) use ($request) {
                                    $query->whereMonth('tanggal',$request->daftarbulan);
                                 })
                                ->get();
            
            $pdf = PDF::loadview('invent/lapajuan.aduan',compact('user','data','request'));
            return $pdf->stream();
        // }else{
        //     dd($request->all());
        }
    }

   
}
