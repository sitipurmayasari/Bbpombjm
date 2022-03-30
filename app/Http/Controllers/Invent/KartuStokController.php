<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventaris;
use App\Jenisbrg;
use App\Divisi;
use App\Entrystock;
use App\Satuan;
use App\Lokasi;
use App\Labory;
use App\Sbb;
use App\Sbbdetail;
use Carbon\Carbon;
use PDF;
class KartuStokController extends Controller
{
    public function index()
    {
        $div        = Divisi::where('id','!=','1');
        $jenis      = Jenisbrg::all();
        $dataman    = Inventaris::whereRaw('kind not in ("R")')->get();
        $lab        = Labory::all();
        return view('invent/kartustok.index',compact('dataman','jenis','div','lab'));
    }

    public function cetak(Request $request)
    {       
        if ($request->jenis_Laporan=='1') {
            $now = Carbon::now()->month;

            $stock = EntryStock::SelectRaw('entrystock.*, (stockawal-stock) AS keluar')
                                ->LeftJoin('inventaris','inventaris.id','=','entrystock.inventaris_id')
                                ->Where('inventaris_id',$request->inventaris_id)
                                ->get();
            $data = Inventaris::Where('id',$request->inventaris_id)->first();
            $pdf = PDF::loadview('invent/kartustok.stokbarang',compact('stock','request','data','now'));
            return $pdf->stream();
        }else if($request->jenis_Laporan=="2"){
            $stock = Inventaris::Orderby('stok','desc')
                                ->SelectRaw('DISTINCT(inventaris.id),nama_barang, inventaris.satuan_id,merk, lokasi, kode_barang, SUM(stock) AS stok')
                                ->LeftJoin('entrystock','inventaris.id','=','entrystock.inventaris_id')
                                ->Where('kind','!=','R')
                                ->Where('jenis_barang',$request->kelompok)
                                ->GroupBY('inventaris.id')
                                ->get();
            $data = Jenisbrg::where('id',$request->kelompok)->first();
            return view('invent/kartustok.stokkelompok',compact('stock','data','request'));
            // $pdf = PDF::loadview('invent/kartustok.stokkelompok',compact('stock','data','request'));
            // return $pdf->stream();
        } else if($request->jenis_Laporan=="3"){
            $stock = Inventaris::SelectRaw('inventaris.*, SUM(sbb_detail.jumlah) AS jumlah')
                                ->LeftJoin('sbb_detail','inventaris.id','=','sbb_detail.inventaris_id')
                                ->LeftJoin('sbb','sbb.id','=','sbb_detail.sbb_id')
                                ->Where('sbb.labory_id',$request->labory)
                                ->Where('sbb_detail.status','Y')
                                ->whereYear('sbb.tanggal',$request->years)
                                ->get();
            $data = Labory::where('id',$request->labory)->first();
            $pdf = PDF::loadview('invent/kartustok.stoklab',compact('stock','data','request'));
            return $pdf->stream();
        } else if($request->jenis_Laporan=="4"){
            $data = Sbb::Where('stat_aduan','=','S')
                        ->orderby('id','asc')
                        ->whereYear('tanggal',$request->years)
                        ->whereMonth('tanggal',$request->bulan)
                        ->get();
            return view('invent/kartustok.laporansbbk',compact('data','request'));
        }else{
            dd($request->all());
        }
        
    }
   
}