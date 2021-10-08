<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Activitycode;
use App\Subcode;
use App\Accountcode;
use App\Loka;
use App\Realisasi;
Use App\RealisasiDetail;
use PDF;

class ReraController extends Controller
{
    public function index(Request $request)
    {
        $loka = Loka::all();
        return view('finance/rera.index',compact('loka'));
    }


    public function cetakrekap(Request $request)
    {
       
        if($request->jenis=="1"){
            $data = Realisasi::orderBy('realisasi.id','asc')
                                ->SelectRaw('realisasi.*, pok.year, pok.asal_pok, activitycode.lengkap AS act, 
                                            subcode.kodeall AS sub, accountcode.code AS akun, loka.nama')
                                ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                ->LeftJoin('accountcode','accountcode.id','=','pok_detail.accountcode_id')
                                ->LeftJoin('subcode','subcode.id','=','pok_detail.subcode_id')
                                ->LeftJoin('activitycode','activitycode.id','=','pok.activitycode_id')
                                ->leftJoin('loka','loka.id','=','pok_detail.loka_id')
                                ->where('pok.year',$request->tahun)
                                ->get();
            $total = RealisasiDetail::SelectRaw('SUM(biaya) AS total')
                                ->LeftJoin('realisasi','realisasi.id','=','realisasi_detail.realisasi_id')
                                ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                ->where('pok.year',$request->tahun)
                                ->first();
            $bulan = RealisasiDetail::SelectRaw('distinct(month)')
                                ->LeftJoin('realisasi','realisasi.id','=','realisasi_detail.realisasi_id')
                                ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                ->where('pok.year',$request->tahun)
                                ->orderBy('realisasi_detail.month','asc')
                                ->get();

            $pdf = PDF::loadview('finance/rera.rekapminggu',compact('data','request','total','bulan'));
            return $pdf->stream();

        }else if($request->jenis=="2"){
            $data = Realisasi::orderBy('realisasi.id','asc')
                                ->SelectRaw('realisasi.*, pok.year, pok.asal_pok, activitycode.lengkap AS act, 
                                            subcode.kodeall AS sub, accountcode.code AS akun, loka.nama')
                                ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                ->LeftJoin('accountcode','accountcode.id','=','pok_detail.accountcode_id')
                                ->LeftJoin('subcode','subcode.id','=','pok_detail.subcode_id')
                                ->LeftJoin('activitycode','activitycode.id','=','pok.activitycode_id')
                                ->leftJoin('loka','loka.id','=','pok_detail.loka_id')
                                ->where('pok.year',$request->tahun)
                                ->get();
            $bulan = RealisasiDetail::SelectRaw('distinct(month)')
                                ->LeftJoin('realisasi','realisasi.id','=','realisasi_detail.realisasi_id')
                                ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                ->where('pok.year',$request->tahun)
                                ->orderBy('realisasi_detail.month','asc')
                                ->get();
            $pdf = PDF::loadview('finance/rera.rekapbulan',compact('data','request','bulan'));
            return $pdf->stream();

        }else if($request->jenis=="3"){
            $data = Realisasi::orderBy('realisasi.id','asc')
                                ->SelectRaw('realisasi.*, pok.year, pok.asal_pok, activitycode.lengkap AS act, 
                                            subcode.kodeall AS sub, accountcode.code AS akun, loka.nama')
                                ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                ->LeftJoin('accountcode','accountcode.id','=','pok_detail.accountcode_id')
                                ->LeftJoin('subcode','subcode.id','=','pok_detail.subcode_id')
                                ->LeftJoin('activitycode','activitycode.id','=','pok.activitycode_id')
                                ->leftJoin('loka','loka.id','=','pok_detail.loka_id')
                                ->where('pok.year',$request->tahun)
                                ->get();
            $bulan = RealisasiDetail::SelectRaw('distinct(month)')
                                ->LeftJoin('realisasi','realisasi.id','=','realisasi_detail.realisasi_id')
                                ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                ->where('pok.year',$request->tahun)
                                ->orderBy('realisasi_detail.month','asc')
                                ->get();
            $pdf = PDF::loadview('finance/rera.rekaptw',compact('data','request','bulan'));
            return $pdf->stream();

        }else{
            dd($request->all());
        }
    }

}
