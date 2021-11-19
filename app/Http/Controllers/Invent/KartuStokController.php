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
use PDF;
class KartuStokController extends Controller
{
    public function index()
    {
        $div        = Divisi::where('id','!=','1');
        $jenis      = Jenisbrg::all();
        $dataman    = Inventaris::where('kind','D')->get();
        return view('invent/kartustok.index',compact('dataman','jenis','div'));
    }

    public function cetak(Request $request)
    {       
        if ($request->jenis_Laporan=='1') {
            $stock = EntryStock::SelectRaw('entrystock.*, (stockawal-stock) AS keluar')
                                ->LeftJoin('inventaris','inventaris.id','=','entrystock.inventaris_id')
                                ->Where('inventaris_id',$request->inventaris_id)
                                ->whereYear('entry_date',$request->years)
                                ->when($request->bulan, function ($query) use ($request) {
                                    if($request->bulan==2){
                                        $query->whereMonth('entry_date',$request->daftarbulan);
                                    }
                                 })
                                ->get();
            $data = Inventaris::Where('id',$request->inventaris_id)->first();
            $pdf = PDF::loadview('invent/kartustok.stokbarang',compact('stock','request','data'));
            return $pdf->stream();
        }else if($request->jenis_Laporan=="2"){
            $stock = Inventaris::SelectRaw('DISTINCT(inventaris.id),nama_barang, satuan_id,lokasi, SUM(stock) AS stok')
                                ->LeftJoin('entrystock','inventaris.id','=','entrystock.inventaris_id')
                                ->Where('kind','=','D')
                                ->Where('jenis_barang',$request->kelompok)
                                ->GroupBY('inventaris.id')
                                ->get();
            $data = Jenisbrg::where('id',$request->kelompok)->first();
            $pdf = PDF::loadview('invent/kartustok.stokkelompok',compact('stock','data','request'));
            return $pdf->stream();
        } else {
            dd($request->all());
        }
        
    }
   
}