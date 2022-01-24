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
            $stock = EntryStock::SelectRaw('entrystock.*, (stockawal-stock) AS keluar')
                                ->LeftJoin('inventaris','inventaris.id','=','entrystock.inventaris_id')
                                ->Where('inventaris_id',$request->inventaris_id)
                                ->whereYear('entry_date',$request->years)
                                ->get();
            $data = Inventaris::Where('id',$request->inventaris_id)->first();
            $pdf = PDF::loadview('invent/kartustok.stokbarang',compact('stock','request','data'));
            return $pdf->stream();
        }else if($request->jenis_Laporan=="2"){
            $stock = Inventaris::SelectRaw('DISTINCT(inventaris.id),nama_barang, inventaris.satuan_id,lokasi, SUM(stock) AS stok, SUM(jumlah) AS keluar')
                                ->LeftJoin('entrystock','inventaris.id','=','entrystock.inventaris_id')
                                ->LeftJoin('sbb_detail','inventaris.id','=','sbb_detail.inventaris_id')
                                ->Where('kind','=','D')
                                ->Where('jenis_barang',$request->kelompok)
                                ->whereYear('sbb_detail.created_at',$request->years)
                                ->GroupBY('inventaris.id')
                                ->get();
            $data = Jenisbrg::where('id',$request->kelompok)->first();
            $pdf = PDF::loadview('invent/kartustok.stokkelompok',compact('stock','data','request'));
            return $pdf->stream();
        } else if($request->jenis_Laporan=="2"){
            $stock = Sbbdetail::SelectRaw('sbb_detail.* , inventaris.nama_barang, sbb.tanggal, satuan.satuan')
                                ->LeftJoin('sbb','sbb.id','=','sbb_detail.sbb_id')
                                ->LeftJoin('inventaris','inventaris.id','=','sbb_detail.inventaris_id')
                                ->LeftJoin('satuan','satuan.id','=','sbb_detail.satuan_id')
                                ->Where('sbb.labory_id',$request->labory)
                                ->Where('sbb_detail.status','Y')
                                ->whereYear('sbb.tanggal',$request->years)
                                ->get();
            $data = Labory::where('id',$request->labory)->first();
            $pdf = PDF::loadview('invent/kartustok.stoklab',compact('stock','data','request'));
        }else{
            dd($request->all());
        }
        
    }
   
}