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
use App\User;
use App\Expenses;
use App\Expenses_daily;
use App\Travelexpenses;
use App\Travelexpenses1;
use App\Travelexpenses2;
use App\Pok_detail;

class OutReportController extends Controller
{
    public function index()
    {
        $user = User::where('aktif','Y')->where('id','!=','1')->OrderBy('name','asc')->get();
        $div = Divisi::where('id','!=','1')->get();
        $pok = Pok_detail::whereraw('pok_detail.id IN (SELECT pok_detail_id FROM outstation WHERE pok_detail_id != 0 GROUP BY pok_detail_id)')
                        ->get();
        return view('finance/outreport.index',compact('div' , 'user','pok'));
    }

    public function cetak(Request $request)
    {
        // dd($request->all());
        if ($request->jenis_Laporan=="ST") {
            $data = Outstation::orderBy('id','desc')
                            ->whereraw('outstation.deleted_at IS null')
                            ->when($request->divisi, function ($query) use ($request) {
                               $query->where('divisi_id',$request->divisi);
                            })
                            ->when($request->daftartahun, function ($query) use ($request) {
                                $query->whereYear('outstation.st_date',$request->daftartahun);
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
                                ->whereraw('outstation.deleted_at IS null')
                                ->when($request->divisi, function ($query) use ($request) {
                                $query->where('outstation.divisi_id',$request->divisi);
                                })
                                ->when($request->daftartahun, function ($query) use ($request) {
                                    $query->whereYear('outstation.st_date',$request->daftartahun);
                                 })
                                ->when($request->bulan, function ($query) use ($request) {
                                    if($request->bulan==2){
                                        $query->whereMonth('outstation.st_date',$request->daftarbulan);
                                    }
                                })
                                ->get();
            // $pdf = PDF::loadview('finance/outreport.cetakpeg',compact('data','request'));
            // return $pdf->stream(); 
            return view('finance/outreport.cetakpeg',compact('data','request'));

        }elseif($request->jenis_Laporan=="tgl"){
            // dd($request->all());
            $data = Outst_employee::orderBy('outst_employee.id','asc')
                                ->leftJoin('outstation','outstation.id','=','outst_employee.outstation_id')
                                ->whereraw('outstation.deleted_at IS null')
                                ->WhereRaw('outstation.st_date between "'.$request->awal.'" AND "'.$request->akhir.'"')
                                ->get();
            // $pdf = PDF::loadview('finance/outreport.cetakpeg',compact('data','request'));
            // return $pdf->stream(); 
            return view('finance/outreport.cetaktgl',compact('data','request'));
            
        }elseif($request->jenis_Laporan=="Per"){
            $pegawai = User::where('id',$request->users)->first();
            $data = Outst_employee::orderBy('outst_employee.id','asc')
                                ->leftJoin('outstation','outstation.id','=','outst_employee.outstation_id')
                                ->where('outst_employee.users_id',$request->users)
                                ->whereraw('outstation.deleted_at IS null')
                                ->when($request->divisi, function ($query) use ($request) {
                                $query->where('outstation.divisi_id',$request->divisi);
                                })
                                ->when($request->daftartahun, function ($query) use ($request) {
                                    $query->whereYear('outstation.st_date',$request->daftartahun);
                                 })
                                ->when($request->bulan, function ($query) use ($request) {
                                    if($request->bulan==2){
                                        $query->whereMonth('outstation.st_date',$request->daftarbulan);
                                    }
                                })
                                ->get();
            // $pdf = PDF::loadview('finance/outreport.cetakper',compact('data','request','pegawai'));
            // return $pdf->stream();     
            return view('finance/outreport.cetakper',compact('data','request','pegawai'));            
        }elseif($request->jenis_Laporan=="Kui"){
            $data = Travelexpenses::orderBy('outstation_id','asc')
                            ->SelectRaw('travelexpenses.*')
                            ->leftjoin('outst_employee','outst_employee.id','travelexpenses.outst_employee_id')
                            ->leftjoin('outstation','outstation.id','outst_employee.outstation_id')
                            ->when($request->pok_detail, function ($query) use ($request) {
                                $query->where('outstation.pok_detail_id',$request->pok_detail);
                            })
                            ->when($request->divisi, function ($query) use ($request) {
                               $query->where('outstation.divisi_id',$request->divisi);
                            })
                            ->when($request->daftartahun, function ($query) use ($request) {
                                $query->whereYear('outstation.st_date',$request->daftartahun);
                             })
                             ->when($request->bulan, function ($query) use ($request) {
                                if($request->bulan==2){
                                    $query->whereMonth('outstation.st_date',$request->daftarbulan);
                                }
                             })
                            ->get();
            $bidang = Divisi::where('id', $request->divisi)->first();
            $pokdet = Pok_detail::where('id', $request->pok_detail)->first();
            // return view('finance/outreport.cetaklapkui',compact('data','request','bidang','pokdet'));
             $pdf = PDF::loadview('finance/outreport.cetaklapkui',compact('data','request','bidang','pokdet')); 
             return $pdf->stream();                  
        } else {
            dd($request->all());

        }            
    } 

}
