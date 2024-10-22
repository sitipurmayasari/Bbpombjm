<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Inventaris;
use App\Jenisbrg;
use App\Divisi;
use App\Entrystock;
use App\Satuan;
use App\Lokasi;
use App\Labory;
use App\Sbb;
use App\Sbbdetail;
use App\Petugas;
use App\Pejabat;
use Carbon\Carbon;
use PDF;
use Excel;
class KartuStokController extends Controller
{
    public function index()
    {
        $div        = Divisi::where('id','!=','1');
        $jenis      = Jenisbrg::all();
        $dataman    = Inventaris::whereRaw('kind not in ("R")')->get();
        $lab        = Labory::all();
        $gudang     = Lokasi::all();
        return view('invent/kartustok.index',compact('dataman','jenis','div','lab','gudang'));
    }

    public function cetak(Request $request)
    {       
        if ($request->jenis_Laporan=="1") {
            $now = Carbon::now()->month;

            $stock = EntryStock::orderby('entry_date','asc')
                                ->LeftJoin('inventaris','inventaris.id','=','entrystock.inventaris_id')
                                ->Where('inventaris_id',$request->inventaris_id)
                                ->get();
            $data = Inventaris::Where('id',$request->inventaris_id)->first();
            $pdf = PDF::loadview('invent/kartustok.stokbarang',compact('stock','request','data','now'));
            return $pdf->stream();
        }else if($request->jenis_Laporan=="2"){

            $stock = Inventaris::OrderBy('stock','desc')
                        ->SelectRaw('inventaris.*,  entrystock.stock')
                        ->LeftJoin(DB::raw("(SELECT MAX(id) as max_id, inventaris_id FROM entrystock GROUP BY inventaris_id) stok"),
                                            'stok.inventaris_id','=','inventaris.id')
                        ->LeftJoin('entrystock','stok.max_id','=','entrystock.id')
                        ->Where('kind','!=','R')                   
                        ->Where('jenis_barang',$request->kelompok)
                        ->when($request->gudang, function ($query) use ($request) {
                                $query->where('inventaris.lokasi',$request->gudang);
                            })
                        ->get();

            $petugas = Petugas::where('id', '=', 4)->first();

            $mengetahui = Pejabat::where('jabatan_id', '=', 11)
                          ->where('divisi_id', '=', 2)
                          ->first();
            $gudang = Lokasi::where('id',$request->gudang)->first();
            $data = Jenisbrg::where('id',$request->kelompok)->first();

            return view('invent/kartustok.stokkelompok',compact('stock','data','request','petugas','mengetahui','gudang'));

        } else if($request->jenis_Laporan=="3"){
            $stock = Inventaris::SelectRaw('inventaris_id, SUM(jumlah) AS jumlah, inventaris.*')
                                ->LeftJoin('sbb_detail','inventaris.id','=','sbb_detail.inventaris_id')
                                ->LeftJoin('sbb','sbb.id','=','sbb_detail.sbb_id')
                                ->Where('sbb.labory_id',$request->labory)
                                ->Where('sbb_detail.status','Y')
                                ->whereYear('sbb.tanggal',$request->years)
                                ->GroupBy('inventaris_id')
                                ->get();
            $data = Labory::where('id',$request->labory)->first();
            return view('invent/kartustok.stoklab',compact('stock','data','request'));
            // $pdf = PDF::loadview('invent/kartustok.stoklab',compact('stock','data','request'));
            // return $pdf->stream();
        } else if($request->jenis_Laporan=="4"){
            $data = Sbb::Where('stat_aduan','=','D')
                        ->orderby('id','asc')
                        ->whereYear('tanggal',$request->years)
                        ->whereMonth('tanggal',$request->bulan)
                        ->get();
            $petugas = Petugas::where('id', '=', 4)->first();
            $mengetahui = Pejabat::where('jabatan_id', '=', 11)
                                      ->where('divisi_id', '=', 2)
                                      ->first();
            return view('invent/kartustok.laporansbbk',compact('data','request','petugas','mengetahui'));
        }else{
            $data = Inventaris::SelectRaw('inventaris.*, SUM(sbb_detail.jumlah) AS keluar')
                            ->LeftJoin('sbb_detail','inventaris.id','=','sbb_detail.inventaris_id')
                            ->leftjoin('sbb','sbb.id','=','sbb_detail.sbb_id')
                            ->Where('sbb_detail.status','=','Y')
                            ->Where('jenis_barang',$request->kelompok)
                            ->GroupBY('inventaris.id')
                            ->whereYear('sbb.tanggal',$request->years)
                            ->whereMonth('sbb.tanggal',$request->bulan)
                            ->get();
            return view('invent/kartustok.laporanduitnya',compact('data','request')); 
        }
        
    }
   
}