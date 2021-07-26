<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Activitycode;
use App\Subcode;
use App\Accountcode;
use App\Loka;
use App\realisasi;
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
            $data = RealisasiDetail::orderBy('realisasi_detail.id','asc')
                                ->SelectRaw('realisasi_detail.*, pok.year, pok.asal_pok, pok.asal, 
                                            pok.kode_asal, subcode.kodeall, accountcode.code, loka.nama AS lokasi')
                                ->LeftJoin('realisasi','realisasi.id','=','realisasi_detail.realisasi_id')
                                ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                ->LeftJoin('subcode','subcode.id','=','realisasi.subcode_id')
                                ->LeftJoin('accountcode','accountcode.id','=','realisasi.accountcode_id')
                                ->LeftJoin('loka','loka.id','=','realisasi.loka_id')
                                ->where('pok.year',$request->tahun)
                                ->where('realisasi_detail.month',$request->bulan)
                                ->where('realisasi_detail.week',$request->minggu)
                                ->get();
            $total = RealisasiDetail::SelectRaw('SUM(biaya) AS total')
                                ->LeftJoin('realisasi','realisasi.id','=','realisasi_detail.realisasi_id')
                                ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                ->where('pok.year',$request->tahun)
                                ->where('realisasi_detail.month',$request->bulan)
                                ->where('realisasi_detail.week',$request->minggu)
                                ->first();
            $pdf = PDF::loadview('finance/rera.rekapminggu',compact('data','request','total'));
            return $pdf->stream();

        }else if($request->jenis=="2"){
            $data = RealisasiDetail::orderBy('realisasi_detail.id','asc')
                                ->SelectRaw('realisasi_detail.*, pok.year, pok.asal_pok, pok.asal, 
                                            pok.kode_asal, subcode.kodeall, accountcode.code, loka.nama AS lokasi')
                                ->LeftJoin('realisasi','realisasi.id','=','realisasi_detail.realisasi_id')
                                ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                ->LeftJoin('subcode','subcode.id','=','realisasi.subcode_id')
                                ->LeftJoin('accountcode','accountcode.id','=','realisasi.accountcode_id')
                                ->LeftJoin('loka','loka.id','=','realisasi.loka_id')
                                ->where('pok.year',$request->tahun)
                                ->where('realisasi_detail.month',$request->bulan)
                                ->get();
            $total = RealisasiDetail::SelectRaw('SUM(biaya) AS total')
                                ->LeftJoin('realisasi','realisasi.id','=','realisasi_detail.realisasi_id')
                                ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                ->where('pok.year',$request->tahun)
                                ->where('realisasi_detail.month',$request->bulan)
                                ->first();
            $pdf = PDF::loadview('finance/rera.rekapbulan',compact('data','request','total'));
            return $pdf->stream();

        }else if($request->jenis=="3"){
            $data = RealisasiDetail::orderBy('realisasi_detail.id','asc')
                            ->SelectRaw('realisasi_detail.*, pok.year, pok.asal_pok, pok.asal, 
                                        pok.kode_asal, subcode.kodeall, accountcode.code, loka.nama AS lokasi')
                            ->LeftJoin('realisasi','realisasi.id','=','realisasi_detail.realisasi_id')
                            ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                            ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                            ->LeftJoin('subcode','subcode.id','=','realisasi.subcode_id')
                            ->LeftJoin('accountcode','accountcode.id','=','realisasi.accountcode_id')
                            ->LeftJoin('loka','loka.id','=','realisasi.loka_id')
                            ->where('pok.year',$request->tahun)
                            ->where('realisasi_detail.month',$request->bulan)
                            ->get();
            $total = RealisasiDetail::SelectRaw('SUM(biaya) AS total')
                                    ->LeftJoin('realisasi','realisasi.id','=','realisasi_detail.realisasi_id')
                                    ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                    ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                    ->where('pok.year',$request->tahun)
                                    ->where('realisasi_detail.month',$request->bulan)
                                    ->first();
            $pdf = PDF::loadview('finance/rera.rekaptw',compact('data','request','total'));
            return $pdf->stream();

        }else{
            dd($request->all());
        }
    }

}
