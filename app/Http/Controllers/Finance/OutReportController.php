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

class OutReportController extends Controller
{
    public function index()
    {
        $user = User::where('aktif','Y')->where('id','!=','1')->OrderBy('name','asc')->get();
        $div = Divisi::where('id','!=','1')->get();
        return view('finance/outreport.index',compact('div' , 'user'));
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
        }elseif($request->jenis_Laporan=="Per"){
            $pegawai = User::where('id',$request->users)->first();
            $data = Outst_employee::orderBy('outst_employee.id','asc')
                                ->leftJoin('outstation','outstation.id','=','outst_employee.outstation_id')
                                ->where('outst_employee.users_id',$request->users)
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
            $pdf = PDF::loadview('finance/outreport.cetakper',compact('data','request','pegawai'));
            return $pdf->stream();                  
        }elseif($request->jenis_Laporan=="Kui"){
            $data = Expenses_daily::Orderby('outstation.id','asc')
                            ->SelectRaw('users.name, expenses_daily.*, outst_employee_id, outstation.*')
                            ->LeftJoin('outst_employee','expenses_daily.outst_employee_id','=','outst_employee.id')
                            ->LeftJoin('users','users.id','=','outst_employee.users_id')
                            ->LeftJoin('expenses','expenses.id','=','expenses_daily.expenses_id')
                            ->LeftJoin('outstation','outstation.id','=','expenses.outstation_id')
                            ->when($request->divisi, function ($query) use ($request) {
                               $query->where('outstation.divisi_id',$request->divisi);
                            })
                            ->when($request->tahun, function ($query) use ($request) {
                                if($request->tahun==2){
                                    $query->whereYear('expenses.date',$request->daftartahun);
                                }
                             })
                             ->when($request->bulan, function ($query) use ($request) {
                                if($request->bulan==2){
                                    $query->whereMonth('expenses.date',$request->daftarbulan);
                                }
                             })
                            ->get();
            $bidang = Divisi::where('id', $request->divisi)->first();
            return view('finance/outreport.cetaklapkui',compact('data','request','bidang'));                   
        } else {
            dd($request->all());

        }            
    } 

}
