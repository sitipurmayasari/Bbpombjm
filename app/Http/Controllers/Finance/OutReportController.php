<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PDF;
use DateTime;
use App\Divisi;
use App\Outstation;
use App\Outst_employee;
use App\Outst_destiny;
use App\Users;

class OutReportController extends Controller
{
    public function index()
    {
        $div = Divisi::where('id','!=','1')->get();
        return view('finance/outreport.index',compact('div'));
    }

    public function cetak(Request $request)
    {
        // dd($request->all());
        if ($request->jenis_Laporan=="ST") {
            $data = Outstation::orderBy('id','desc')
                            ->when($request->divisi, function ($query) use ($request) {
                               $query->where('divisi_id',$request->divisi);
                            })
                            ->when($request->tahun, function ($query) use ($request) {
                                if($request->tahun==2){
                                    $query->whereYear('st_date',$request->daftartahun);
                                }
                             })
                             ->when($request->bulan, function ($query) use ($request) {
                                if($request->bulan==2){
                                    $query->whereMonth('st_date',$request->daftarbulan);
                                }
                             })
                            ->get();
            $pdf = PDF::loadview('finance/outreport.cetakdaftarst',compact('data','request'));
            return $pdf->stream();

        }elseif($request->jenis_Laporan=="Peg"){
            // dd($request->all());
            $data = Outst_employee::orderBy('outst_employee.id','asc')
                                ->leftJoin('outstation','outstation.id','=','outst_employee.outstation_id')
                                
                                ->when($request->divisi, function ($query) use ($request) {
                                $query->where('outstation.divisi_id',$request->divisi);
                                })
                                ->when($request->tahun, function ($query) use ($request) {
                                    if($request->tahun==2){
                                        $query->whereYear('outstation.st_date',$request->daftartahun);
                                    }
                                })
                                ->when($request->bulan, function ($query) use ($request) {
                                    if($request->bulan==2){
                                        $query->whereMonth('outstation.st_date',$request->daftarbulan);
                                    }
                                })
                                ->get();
            $pdf = PDF::loadview('finance/outreport.cetakpeg',compact('data','request'));
            return $pdf->stream();                     
        } else {
            dd($request->all());

        }            
    } 

}
