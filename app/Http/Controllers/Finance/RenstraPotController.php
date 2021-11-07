<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Perspective;
use App\Target;
use App\Indicator;
use App\Renstranas;
use App\Renstranas_detail;
use App\Renstrakal;
use App\Renstrakal_detail;
use App\Pejabat;
use Excel;
use PDF;
use DateTime;

class RenstraPotController extends Controller
{
    public function index()
    {
        $nas = Renstranas::all();
        $balai = Renstrakal::all();
        return view('finance/renstrapot.index',compact('nas','balai'));
    }

    public function cetak(Request $request)
    {
        // dd($request->all());
        if ($request->jenis=="N") {
            $indi = Indicator::all();
            $data = Renstranas_detail::orderBy('id','desc')
                                    ->where('renstranas_id',$request->renstranas_id)
                                    ->get();
            $kepala = Renstranas::where('id',$request->renstranas_id)->first();
            
            $thn = Renstranas_detail::SelectRaw('DISTINCT YEARS AS tahun')
                                    ->where('renstranas_id',$request->renstranas_id)
                                    ->get();
            $menyetujui = Pejabat::where('jabatan_id', '=', 6)
                                    ->whereRaw("(SELECT dates FROM renstranas WHERE id=$request->renstranas_id) BETWEEN dari AND sampai")
                                    ->first();
            return view('finance/renstrapot.cetaknas',compact('data','request','kepala','thn','indi','menyetujui'));
            

        }elseif($request->jenis=="B"){
            $indi = Indicator::all();
            $data = Renstrakal_detail::orderBy('id','desc')
                                    ->where('renstrakal_id',$request->renstrakal_id)
                                    ->get();
            $kepala = Renstrakal::where('id',$request->renstrakal_id)->first();
            $thn = Renstrakal_detail::SelectRaw('DISTINCT YEARS AS tahun')
                                    ->where('renstrakal_id',$request->renstrakal_id)
                                    ->get();
            $menyetujui = Pejabat::where('jabatan_id', '=', 6)
                                    ->whereRaw("(SELECT dates FROM renstrakal WHERE id=$request->renstrakal_id) BETWEEN dari AND sampai")
                                    ->first();
            return view('finance/renstrapot.cetakkal',compact('data','request','kepala','thn','indi','menyetujui'));                   
        } else {
            dd($request->all());

        }            
    } 
}
