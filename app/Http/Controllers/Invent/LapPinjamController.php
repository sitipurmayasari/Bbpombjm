<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Aduan;
use App\JadwalMain;
use App\Lokasi;
use App\Inventaris;
use App\Maintenance;
use App\Petugas;
use PDF;
class LaporanController extends Controller
{
    public function index()
    {
        $jadwal = JadwalMain::all();
        $aduan = Aduan::all();
        $lokasi = Lokasi::all();
        $data = Inventaris::all();
        return view('invent/laporan.index',compact('aduan','jadwal','lokasi','data'));
    }
    public function cetak(Request $request)
    {
        $divisi = "";
        if($request->jenis_Laporan=="Tjawab"){
            $user = User::all();
            $data = Inventaris::orderBy('id','desc')
                                ->when($request->lokasi, function ($query) use ($request) {
                                   $query->where('lokasi',$request->lokasi);
                                })
                                ->when($request->tahun, function ($query) use ($request) {
                                    if($request->tahun==2){
                                        $query->whereYear('tanggal_diterima',$request->daftartahun);
                                    }
                                 })
                                ->get();
            if($request->lokasi!=""){
                $lokasi = Lokasi::where('id',$request->lokasi)->first();
            }
            $pdf = PDF::loadview('invent/laporan.createtjawab',compact('user','divisi','data','request','lokasi'));
            return $pdf->stream();

        }else if($request->jenis_Laporan=="Main"){
            $lokasi = Lokasi::all();
            $user = User::all();
            $inv = Inventaris::where('id',$request->inventaris_id)->first();
            $petugas = Petugas::where('id', '=', 2)->first();
            $data = Maintenance::orderBy('id','desc')
                                ->when($request->inventaris_id, function ($query) use ($request) {
                                   $query->where('inventaris_id',$request->inventaris_id);
                                })
                                ->when($request->tahun, function ($query) use ($request) {
                                    if($request->tahun==2){
                                        $query->whereYear('tgl_pelihara',$request->daftartahun);
                                    }
                                 })
                    ->get();
            
            $pdf = PDF::loadview('invent/laporan.createmain',compact('user','lokasi','data','inv','request','petugas'));
            return $pdf->stream();
        

        }else if($request->jenis_Laporan=="Daftar"){
            $user = User::all();
            $data = Inventaris::orderBy('id','desc')
                                ->when($request->lokasi, function ($query) use ($request) {
                                   $query->where('lokasi',$request->lokasi);
                                })
                                ->when($request->tahun, function ($query) use ($request) {
                                    if($request->tahun==2){
                                        $query->whereYear('tanggal_diterima',$request->daftartahun);
                                    }
                                 })
                                 ->get();
                                // ->paginate('10');
            if($request->lokasi!= ""){
                 $lokasi = Lokasi::where('id',$request->lokasi)->first()->nama;
            }
            $pdf = PDF::loadview('invent/laporan.createdabar',compact('user','data','request','lokasi'));
            return $pdf->stream();
        }else{
            dd($request->all());
        }
    }

    public function createtjawab($request)
    {
        $divisi = Divisi::all();
        $user = User::all();
        $data = Inventaris::orderBy('id','desc')
                            ->when($request->lokasi, function ($query) use ($request) {
                               $query->where('lokasi',$request->lokasi);
                            })
                            ->when($request->tahun, function ($query) use ($request) {
                                if($request->tahun==2){
                                    $query->whereYear('tanggal_diterima',$request->daftartahun);
                                }
                             })
                            ->get();

    	$pdf = PDF::loadview('invent/laporan.createtjawab',compact('user','divisi','data'));
        return $pdf->stream();
    }

    public function createmain()
    {
        $divisi = Divisi::all();
        $user = User::all();
        $inventaris = Inventaris::all();
        $data = Maintenance::orderBy('id','desc')->paginate('10');
        return view('invent/laporan.createmain',compact('user','divisi','data','inventaris'));
    }

    public function createdabar()
    {
        $divisi = Divisi::all();
        $user = User::all();
        $data = Inventaris::orderBy('id','desc')->paginate('10');
        return view('invent/laporan.createdabar',compact('user','divisi','data'));
    }

   
}
