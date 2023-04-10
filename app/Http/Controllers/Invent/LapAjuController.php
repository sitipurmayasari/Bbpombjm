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
use App\AduanTIK;
use Excel;
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

        }else if($request->jenis_Laporan=="rusaktik"){
            $user   = User::all();
            $data   = Aduan::orderBy('id','asc')
                            ->where('jenis','T')
                            ->whereYear('tanggal',$request->daftartahun)
                            ->when($request->piltgl, function ($query) use ($request) {
                                if($request->piltgl==1){
                                    $query->whereYear('tanggal',$request->daftartahun);
                                    $query->whereMonth('tanggal',$request->daftarbulan); 
                                }
                            })
                            ->when($request->piltgl, function ($query) use ($request) {
                                if($request->piltgl==2){
                                    $query->WhereRaw('tanggal between "'.$request->awal.'" AND "'.$request->akhir.'"');
                                }
                             })
                            ->get();
            
            $pdf = PDF::loadview('invent/lapajuan.aduan',compact('user','data','request'));
            return $pdf->stream();
        }else if($request->jenis_Laporan=="rusaktik2"){
            $data   = AduanTIK::orderBy('id','asc')
                            ->whereYear('tanggal',$request->daftartahun)
                            ->when($request->piltgl, function ($query) use ($request) {
                                if($request->piltgl==1){
                                    $query->whereYear('tanggal',$request->daftartahun);
                                    $query->whereMonth('tanggal',$request->daftarbulan); 
                                }
                            })
                            ->get();
            return view('invent/lapajuan.aduantik2',compact('data','request'));
        }else if($request->jenis_Laporan=="rusak"){
            $user   = User::all();
            $data   = AduanDetail::orderBy('aduan_detail.id','asc')
                            ->leftjoin('aduan','aduan.id','aduan_detail.aduan_id')
                            ->where('aduan.jenis','U')
                            ->whereYear('aduan.tanggal',$request->daftartahun)
                            ->when($request->daftarbulan, function ($query) use ($request) {
                                $query->whereYear('aduan.tanggal',$request->daftartahun);
                                $query->whereMonth('aduan.tanggal',$request->daftarbulan);
                                })
                            ->get();
            
            $pdf = PDF::loadview('invent/lapajuan.aduan2',compact('user','data','request'));
            return $pdf->stream();
        }else{
            dd($request->all());
        }
    }

   
}
