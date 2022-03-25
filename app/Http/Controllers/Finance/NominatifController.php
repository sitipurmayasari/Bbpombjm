<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;
use App\Expenses_daily;
use App\nominatif;
use App\nominatif1;
use App\nominatif2;
use App\Expenses;
use App\User;
use App\Destination;
use App\Outstation;
use App\Outst_employee;
use App\Outst_destiny;
use App\Pok_detail;
use App\PPK;
use App\Plane;
use App\Budget;
use App\Petugas;
use App\Pejabat;
use PDF;



class NominatifController extends Controller
{

    public function index(Request $request)
    {
        $data = Expenses::orderBy('id','desc')
                        ->SelectRaw('expenses.*, outstation.number, outstation.purpose')
                        ->leftjoin('outstation','outstation.id','expenses.outstation_id')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('outstation.number','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('outstation.purpose', 'LIKE','%'.$request->keyword.'%');
                        })
                ->paginate('10');
        return view('finance/nominatif.index',compact('data'));
    }

    public function cetak($id)
    {
        $data       = Expenses::where('id',$id)->first();
        $pegawai    = Outst_employee::SelectRaw('outst_employee.*, expenses_daily.*, travelexpenses.*, travelexpenses1.*, travelexpenses2.*, outst_employee.id AS em_id')
                        ->leftJoin('outstation','outstation.id','=','outst_employee.outstation_id')
                        ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
                        ->leftJoin('expenses_daily','expenses_daily.outst_employee_id','=','outst_employee.id')
                        ->leftJoin('travelexpenses','travelexpenses.outst_employee_id','=','outst_employee.id')
                        ->leftJoin('travelexpenses1','travelexpenses1.outst_employee_id','=','outst_employee.id')
                        ->leftJoin('travelexpenses2','travelexpenses2.outst_employee_id','=','outst_employee.id')
                        ->where('expenses.id',$id)
                        ->get();
        $tujuan    = Outst_destiny::SelectRaw('outst_destiny.* ')
                        ->leftJoin('outstation','outstation.id','=','outst_destiny.outstation_id')
                        ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
                        ->where('expenses.id',$id)
                        ->get();
        $menyetujui    = Pejabat::SelectRaw('pejabat.* ')
                        ->leftJoin('outstation','outstation.divisi_id','=','pejabat.divisi_id')
                        ->leftJoin('divisi','divisi.id','=','outstation.divisi_id')
                        ->whereraw('subdivisi_id IS NULL')
                        ->where('outstation.id',$data->outstation_id)
                        ->whereRaw("st_date BETWEEN pejabat.dari AND pejabat.sampai")
                        ->first();
        // $pdf = PDF::loadview('finance/nominatif.cetak',compact('data','pegawai','tujuan','menyetujui'));
        // return $pdf->stream();
        return view('finance/nominatif.cetak',compact('data','pegawai','tujuan','menyetujui'));
    }

}
