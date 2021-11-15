<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Perspective;
use App\Target;
use App\Indicator;
use App\Renstrakal_detail;
use App\Eselontwo_detail;
use App\Setuprenker;
use App\Realrapk;
use App\Realrapk_detail;
use App\Pejabat;

use Excel;
use PDF;
use DateTime;

class LapRAPKController extends Controller
{
    public function index()
    {
        return view('finance/lapRAPK.index');
    }

    public function cetak(Request $request)
    {
        // dd($request->all());
        if ($request->jenis=="1") {
            $indi = Indicator::all();
            $kepala = Realrapk::where('years',$request->years)->where('triwulan',$request->triwulan)->first();
            $data = Realrapk_detail::where('realrapk_id',$kepala->id)->where('realisasi','!=','0')->get();
            $menyetujui = Pejabat::where('jabatan_id', '=', 6)->OrderBy('id','desc')
                                    ->first();
            return view('finance/lapRAPK.cetakone',compact('request','indi','menyetujui','kepala','data'));
            

        }elseif($request->jenis=="2"){
            $indi = Indicator::all();
            $kepala = Realrapk::where('years',$request->years)->where('triwulan',$request->triwulan)->first();
            $data = Realrapk_detail::where('realrapk_id',$kepala->id)->where('realisasi','!=','0')->get();
            $menyetujui = Pejabat::where('jabatan_id', '=', 6)->OrderBy('id','desc')
                                    ->first();
            return view('finance/lapRAPK.cetaktwo',compact('request','indi','menyetujui','kepala','data'));

        }elseif($request->jenis=="3"){
            $indi = Indicator::all();
            $kepala = Realrapk::where('years',$request->years)->where('triwulan',$request->triwulan)->first();
            $data = Realrapk_detail::where('realrapk_id',$kepala->id)->where('realisasi','!=','0')->get();
            $menyetujui = Pejabat::where('jabatan_id', '=', 6)->OrderBy('id','desc')
                                    ->first();
            return view('finance/lapRAPK.cetakthree',compact('request','indi','menyetujui','kepala','data'));             
        } else {
            dd($request->all());

        }            
    } 
}
