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
use App\AduanDetail;

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
            $data   = Pengajuan::orderBy('id','desc')
                                ->when($request->tahun, function ($query) use ($request) {
                                    if($request->tahun==2){
                                        $query->whereYear('tgl_ajuan',$request->daftartahun);
                                    }
                                 })
                                ->get();
            $detail = PengajuanDetail::orderBy('id','desc')
                                ->when($request->tahun, function ($query) use ($request) {
                                    if($request->tahun==2){
                                        $query->whereYear('created_at',$request->daftartahun);
                                    }
                                })
                                ->get();
            $pdf = PDF::loadview('invent/lapajuan.ajuan',compact('user','data','request','detail'));
            return $pdf->stream();

        }else if($request->jenis_Laporan=="rusak"){
            $user   = User::all();
            $data   = Aduan::orderBy('id','desc')
                                ->when($request->tahun, function ($query) use ($request) {
                                    if($request->tahun==2){
                                        $query->whereYear('tgl_ajuan',$request->daftartahun);
                                    }
                                 })
                                ->get();
            $detail = AduanDetail::orderBy('id','desc')
                                ->when($request->tahun, function ($query) use ($request) {
                                    if($request->tahun==2){
                                        $query->whereYear('created_at',$request->daftartahun);
                                    }
                                })
                                ->get();
            
            $pdf = PDF::loadview('invent/lapajuan.aduan',compact('user','data','request','detail'));
            return $pdf->stream();
        // }else{
        //     dd($request->all());
        }
    }

   
}
