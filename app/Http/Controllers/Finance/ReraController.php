<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Activitycode;
use App\Krocode;
use App\Detailcode;
use App\Komponencode;
use App\Subcode;
use App\Accountcode;
use App\Implementation;
use App\Implemen_detail;
use App\Loka;
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
            $head = Implementation::where('year',$request->tahun)
                                    ->first();
            $data = Implemen_detail::orderBy('implementation.detailcode_id','asc')
                                    ->orderBy('implementation.subcode_id','asc')
                                    ->orderBy('implemen_detail.accountcode_id','asc')
                                    ->leftJoin('implementation','implementation.id','=','implemen_detail.implementation_id')
                                    ->where('implementation.year',$request->tahun)
                                    ->get();
            $akun = Implemen_detail::SelectRaw('DISTINCT accountcode_id,subcode_id, SUM(total) AS jum')
                                    ->LeftJoin('implementation','implementation.id','=','implemen_detail.implementation_id')
                                    ->Where('implementation.year',$request->tahun)
                                    ->GroupBy('implemen_detail.accountcode_id')
                                    ->GroupBy('implementation.subcode_id')
                                    ->get();
            $komp = Implementation::SelectRaw('DISTINCT komponencode_id, SUM(total) AS jum')
                                    ->LeftJoin('implemen_detail','implementation.id','=','implemen_detail.implementation_id')
                                    ->Where('implementation.year',$request->tahun)
                                    ->GroupBy('komponencode_id')
                                    ->get();
            $deta = Implementation::SelectRaw('DISTINCT detailcode_id, SUM(total) AS jum')
                                    ->LeftJoin('implemen_detail','implementation.id','=','implemen_detail.implementation_id')
                                    ->Where('implementation.year',$request->tahun)
                                    ->GroupBy('detailcode_id')
                                    ->get();
            $pdf = PDF::loadview('finance/rera.rekapumum',compact('data','request','head','akun','komp','deta'));
            return $pdf->stream();

        }else if($request->jenis=="2"){
            $head = Implementation::SelectRaw('implementation.*, loka.nama as lokasi')
                                    ->leftJoin('implemen_detail','implementation.id','=','implemen_detail.implementation_id')
                                    ->leftJoin('loka','loka.id','=','implemen_detail.loka_id')
                                    ->where('year',$request->tahun)
                                    ->where('implemen_detail.loka_id',$request->loka)
                                    ->first();
            $data = Implemen_detail::orderBy('implementation.detailcode_id','asc')
                                    ->orderBy('implementation.subcode_id','asc')
                                    ->orderBy('implemen_detail.accountcode_id','asc')
                                    ->leftJoin('implementation','implementation.id','=','implemen_detail.implementation_id')
                                    ->where('implementation.year',$request->tahun)
                                    ->where('implemen_detail.loka_id',$request->loka)
                                    ->get();
            $akun = Implemen_detail::SelectRaw('DISTINCT accountcode_id,subcode_id, SUM(total) AS jum')
                                    ->LeftJoin('implementation','implementation.id','=','implemen_detail.implementation_id')
                                    ->Where('implementation.year',$request->tahun)
                                    ->where('implemen_detail.loka_id',$request->loka)
                                    ->GroupBy('implemen_detail.accountcode_id')
                                    ->GroupBy('implementation.subcode_id')
                                    ->get();
            $komp = Implementation::SelectRaw('DISTINCT komponencode_id, SUM(total) AS jum')
                                    ->LeftJoin('implemen_detail','implementation.id','=','implemen_detail.implementation_id')
                                    ->Where('implementation.year',$request->tahun)
                                    ->where('implemen_detail.loka_id',$request->loka)
                                    ->GroupBy('komponencode_id')
                                    ->get();
            $deta = Implementation::SelectRaw('DISTINCT detailcode_id, SUM(total) AS jum')
                                    ->LeftJoin('implemen_detail','implementation.id','=','implemen_detail.implementation_id')
                                    ->Where('implementation.year',$request->tahun)
                                    ->where('implemen_detail.loka_id',$request->loka)
                                    ->GroupBy('detailcode_id')
                                    ->get();
            $pdf = PDF::loadview('finance/rera.rekaploka',compact('data','request','head','akun','komp','deta'));
            return $pdf->stream();

        }else if($request->jenis=="3"){
            $head = Implementation::where('year',$request->tahun)
                                    ->leftJoin('implemen_detail','implementation.id','=','implemen_detail.implementation_id')
                                    ->where('implemen_detail.sd',$request->sd)
                                    ->first();
            $data = Implemen_detail::orderBy('implementation.detailcode_id','asc')
                                    ->orderBy('implementation.subcode_id','asc')
                                    ->orderBy('implemen_detail.accountcode_id','asc')
                                    ->leftJoin('implementation','implementation.id','=','implemen_detail.implementation_id')
                                    ->where('implementation.year',$request->tahun)
                                    ->where('implemen_detail.sd',$request->sd)
                                    ->get();
            $akun = Implemen_detail::SelectRaw('DISTINCT accountcode_id,subcode_id, SUM(total) AS jum')
                                    ->LeftJoin('implementation','implementation.id','=','implemen_detail.implementation_id')
                                    ->Where('implementation.year',$request->tahun)
                                    ->where('implemen_detail.sd',$request->sd)
                                    ->GroupBy('implemen_detail.accountcode_id')
                                    ->GroupBy('implementation.subcode_id')
                                    ->get();
            $komp = Implementation::SelectRaw('DISTINCT komponencode_id, SUM(total) AS jum')
                                    ->LeftJoin('implemen_detail','implementation.id','=','implemen_detail.implementation_id')
                                    ->Where('implementation.year',$request->tahun)
                                    ->where('implemen_detail.sd',$request->sd)
                                    ->GroupBy('komponencode_id')
                                    ->get();
            $deta = Implementation::SelectRaw('DISTINCT detailcode_id, SUM(total) AS jum')
                                    ->LeftJoin('implemen_detail','implementation.id','=','implemen_detail.implementation_id')
                                    ->Where('implementation.year',$request->tahun)
                                    ->where('implemen_detail.sd',$request->sd)
                                    ->GroupBy('detailcode_id')
                                    ->get();
            $pdf = PDF::loadview('finance/rera.rekapsd',compact('data','request','head','akun','komp','deta'));
            return $pdf->stream();
        }else{
            dd($request->all());
        }
    }

}
