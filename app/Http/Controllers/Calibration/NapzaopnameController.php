<?php
namespace App\Http\Controllers\Calibration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Inventaris;
use App\Lokasi;
use App\Satuan;
use App\Jenisbrg;
use App\Entrystock;
use App\Petugas;
use App\Pejabat;
use Carbon\Carbon;
use PDF;

class NapzaopnameController extends Controller
{

    public function index(Request $request)
    {
        $jenis = Jenisbrg::whereraw('id in (3,21)')->get();
        return view('calibration/napzaopname.index',compact('jenis'));
    }

    public function create()
    {
        return view('calibration/napzaopname.create');
    }


    public function cetak(Request $request)
    {
        // dd($request->all());
        $stock = Inventaris::OrderBy('stock','desc')
                        ->SelectRaw('inventaris.*,  entrystock.stock')
                        ->LeftJoin(DB::raw("(SELECT MAX(id) as max_id, inventaris_id FROM entrystock GROUP BY inventaris_id) stok"),
                                            'stok.inventaris_id','=','inventaris.id')
                        ->LeftJoin('entrystock','stok.max_id','=','entrystock.id')
                        ->Where('kind','!=','R')   
                        ->Where('inventaris.lokasi','10')                 
                        ->Where('jenis_barang',$request->kelompok)
                        ->get();

            $petugas = Petugas::where('id', '=', 4)->first();

            $mengetahui = Pejabat::where('jabatan_id', '=', 11)
                        ->where('divisi_id', '=', 2)
                        ->whereRaw("pjs IS null")
                        ->first();
            $gudang = Lokasi::where('id','10')->first();
            $data = Jenisbrg::where('id',$request->kelompok)->first();
            return view('/calibration/napzaopname.cetak',compact('stock','data','request','petugas','mengetahui','gudang'));            
    } 

}
