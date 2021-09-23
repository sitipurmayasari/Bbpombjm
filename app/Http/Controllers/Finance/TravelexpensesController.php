<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Travelexpenses;
use App\Expenses;
use App\User;
use App\Destination;
use App\Outstation;
use App\Outst_employee;
use App\Pok_detail;
use App\PPK;
use App\Plane;
use App\Budget;
use App\Petugas;
use PDF;



class TravelexpensesController extends Controller
{

    public function index(Request $request)
    {
        $data = Expenses::orderBy('id','desc')
                ->paginate('10');
        return view('finance/travelexpenses.index',compact('data'));
    }

    public function create()
    {
        $st = Outstation::all();
        $pok = Pok_detail::selectRaw('DISTINCT(subcode_id),accountcode_id')->get();
        $plane = Plane::all();
        $user = User::where('id','!=','1')->get();
        $driver = User::where('deskjob','LIKE','%Sopir%')->get();

        return view('finance/travelexpenses.create',compact('user','st','plane','driver','pok'));
    }

    function getMaksud(Request $request){
        $st = Outstation::where('id',$request->id)->first();
        $peg = Outst_employee::selectRaw('outst_employee.*, users.name,jabatan_id,deskjob')
                ->leftJoin('users','users.id','=','outst_employee.users_id')
                ->where('outst_employee.outstation_id',$request->id)->get();

        return response()->json([ 
            'success'   => true,
            'st'        =>$st,
            'peg'       =>$peg
        ],200);
    }

    // public function store(Request $request)
    // { 
    //   dd($request->all());
    //   $this->validate($request,[
    //       'outstation_id'  => 'required|unique:outstation',
    //       'date'    => 'required'
    //   ]);

    //   DB::beginTransaction(); 
    //       $kuitansi = Expenses::create($request->all());
    //       $expenses_id = $kuitansi->id;
    //       for ($i = 0; $i < count($request->input('users_id')); $i++){
              
    //           $nomorsppd = $this->getnosppd($request->divisi_id);
    //           $data = [
    //               'outstation_id' => $outstation_id,
    //               'users_id'      => $request->users_id[$i],
    //               'no_sppd'        =>$nomorsppd
    //           ];
    //           Outst_employee::create($data);
    //       }
          
    //       for ($i = 0; $i < count($request->input('destination_id')); $i++){
    //         $tgl1 = new DateTime($request->go_date[$i]);
    //         $tgl2 = new DateTime($request->return_date[$i]);
    //         $daylong_1 = $tgl2->diff($tgl1)->days + 1;
    //         $request->merge(['daylong_1'=>$daylong_1]);
            
    //         $data = [
    //             'outstation_id'   => $outstation_id,
    //             'destination_id'  => $request->destination_id[$i],
    //             'go_date'         =>$request->go_date[$i],
    //             'return_date'     =>$request->go_date[$i],
    //             'longday'         =>$daylong_1
    //         ];
    //         Outst_destiny::create($data);
    //       }

    //       DB::commit();

    //     return redirect('/finance/outstation');

    // }


    public function receipt()
    {
        $petugas = Petugas::where('id', '=', 5)->first();
        $pdf = PDF::loadview('finance/travelexpenses.receipt',compact('petugas'));
        return $pdf->stream();
    }

    public function riil()
    {
        $petugas = Petugas::where('id', '=', 5)->first();
        $pdf = PDF::loadview('finance/travelexpenses.riil',compact('petugas'));
        return $pdf->stream();
    }

}
