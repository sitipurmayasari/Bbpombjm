<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;
use App\Travelexpenses;
use App\Travelexpenses1;
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
        return view('finance/travelexpenses.create',compact('user','st','plane','pok'));
    }

    function getMaksud(Request $request){
        $st     = Outstation::where('id',$request->id)->first();
        $peg    = Outst_employee::selectRaw('outst_employee.*, users.name,jabatan_id,deskjob')
                                ->leftJoin('users','users.id','=','outst_employee.users_id')
                                ->where('outst_employee.outstation_id',$request->id)
                                ->get();
        $tujuan = Outst_destiny::selectRaw('outst_destiny.*, destination.capital')
                                ->leftJoin('destination','destination.id','=','outst_destiny.destination_id')
                                ->where('outst_destiny.outstation_id',$request->id)
                                ->get();
        $lama   = Outst_destiny::selectRaw('sum(longday) as lawas')
                                ->where('outstation_id',$request->id)
                                ->first();
        $dest   = Destination::WhereRaw('id = (SELECT destination_id FROM outst_destiny WHERE outstation_id ='.$request->id.'
                                        ORDER BY id DESC limit 1) ')
                                ->first();

        return response()->json([ 
            'success'   => true,
            'st'        =>$st,
            'peg'       =>$peg,
            'lama'      =>$lama,
            'dest'      =>$dest
        ],200);
    }

    public function store(Request $request)
    { 
    //   dd($request->all());
      $this->validate($request,[
          'outstation_id'   => 'required',
          'date'            => 'required'
      ]);

      DB::beginTransaction(); 
            $expenses = Expenses::create($request->all());
            $expenses_id = $expenses->id;
            for ($i = 0; $i < count($request->input('outst_employee_id')); $i++){
                $dailywage      = $request->dailywage != null ?  $request->dailywage[$i] : 'N';
                $diklat         = $request->diklat != null ?  $request->diklat[$i] : 'N';
                $fullboard      = $request->fullboard != null ?  $request->fullboard[$i] : 'N';
                $fullday        = $request->fullday != null ?  $request->fullday[$i] : 'N';
                $representatif  = $request->representatif != null ?  $request->representatif[$i] : 'N';

                $dataone = [
                    'expenses_id'       => $expenses_id,
                    'outst_employee_id' => $request->outst_employee_id[$i],
                    'dailywage'         => $dailywage,
                    'diklat'            => $diklat,
                    'fullboard'         => $fullboard,
                    'fullday'           => $fullday,
                    'representatif'     => $representatif,
                    'hitdaily'          => $request->hitdaily[$i],
                    'hitdiklat'         => $request->hitdiklat[$i],
                    'hitfullb'          => $request->hitfullb[$i],
                    'hithalf'           => $request->hithalf[$i],
                    'hitrep'            => $request->hitrep[$i]
                ];
                Travelexpenses::create($dataone);
            }
                for ($i = 0; $i < count($request->input('outst_employee_id')); $i++){
                   
                    $datatwo = [
                        'expenses_id'       => $expenses_id,
                        'outst_employee_id' => $request->outst_employee_id[$i],
                        'innname_1'         => $request->innname_1[$i],
                        'inn_fee_1'         => $request->inn_fee_1[$i],
                        'long_stay_1'       => $request->long_stay_1[$i],
                        'isi_1'             => $request->isi_1[$i],
                        'innname_2'         => $request->innname_2[$i],
                        'inn_fee_2'         => $request->inn_fee_2[$i],
                        'long_stay_2'       => $request->long_stay_2[$i],
                        'isi_2'             => $request->isi_2[$i],
                        'bbm'               => $request->bbm[$i],
                        'taxy_count_from'   => $request->taxy_count_from[$i],
                        'taxy_fee_from'     => $request->taxy_fee_from[$i],
                        'taxy_count_to'     => $request->taxy_count_to[$i],
                        'plane_id1'         => $request->plane_id1[$i],
                        'plane_id2'         => $request->plane_id2[$i],
                        'plane_id3'         => $request->plane_id3[$i],
                        'plane_idreturn'    => $request->plane_idreturn[$i],
                        'planenumber1'      => $request->planenumber1[$i],
                        'planenumber2'      => $request->planenumber2[$i],
                        'planenumber3'      => $request->planenumber3[$i],
                        'planenumberreturn' => $request->planenumberreturn[$i],
                        'planefee1'         => $request->planefee1[$i],
                        'planefee2'         => $request->planefee2[$i],
                        'planefee3'         => $request->planefee3[$i],
                        'planereturnfee'    => $request->planereturnfee[$i],
                        'godate1'           => $request->godate1[$i],
                        'godate2'           => $request->godate2[$i],
                        'godate3'           => $request->godate3[$i],
                        'returndate'        => $request->returndate[$i]
    
                    ];
                    Travelexpenses1::create($datatwo);
            }
            DB::commit();



        return redirect('/finance/travelexpenses');

    }

    public function edit($id)
    {
        $st     = Outstation::all();
        $pok    = Pok_detail::selectRaw('DISTINCT(subcode_id),accountcode_id')->get();
        $plane  = Plane::all();
        $user   = User::where('id','!=','1')->get();
        $driver = User::where('deskjob','LIKE','%Sopir%')->get();

        $data   = Expenses::where('id',$id)->first();
        $biaya  = Travelexpenses::where('expenses_id',$id)
                    ->get();

        return view('finance/travelexpenses.edit',compact('user','st','plane','driver','pok', 'data','biaya'));
    }



    public function receipt($id)
    {
        $data       = Expenses::where('id',$id)->first();
        $pegawai    = Outst_employee::SelectRaw('outst_employee.* ')
                                    ->leftJoin('outstation','outstation.id','=','outst_employee.outstation_id')
                                    ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
                                    ->where('expenses.id',$id)
                                    ->get();
        $tujuan    = Outst_destiny::SelectRaw('outst_destiny.* ')
                                    ->leftJoin('outstation','outstation.id','=','outst_destiny.outstation_id')
                                    ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
                                    ->where('expenses.id',$id)
                                    ->get();
        $tr         = Travelexpenses::where('expenses_id',$id)
                                    ->get();
        $lain         = Travelexpenses1::where('expenses_id',$id)
                                    ->get();
    
        $petugas    = Petugas::where('id', '=', 5)->first();
        return view('finance/travelexpenses.receipt',compact('petugas','data','pegawai','tujuan','tr','lain'));
        // $pdf        = PDF::loadview('finance/travelexpenses.receipt',compact('petugas','data','pegawai','tujuan','tr'));
        // return $pdf->stream();
    }


    public function riil($id)
    {
        $petugas    = Petugas::where('id', '=', 5)->first();

        $data       = Expenses::where('id',$id)->first();
        
        $pegawai    = Outst_employee::SelectRaw('outst_employee.* ')
                        ->leftJoin('outstation','outstation.id','=','outst_employee.outstation_id')
                        ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
                        ->where('expenses.id',$id)
                        ->get();
        $tujuan    = Outst_destiny::SelectRaw('outst_destiny.* ')
                        ->leftJoin('outstation','outstation.id','=','outst_destiny.outstation_id')
                        ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
                        ->where('expenses.id',$id)
                        ->get();
        $tr         = Travelexpenses::where('expenses_id',$id)
                        ->get();
        $pdf = PDF::loadview('finance/travelexpenses.riil',compact('petugas','data','pegawai','tujuan','tr'));
        return $pdf->stream();
    }

    public function super($id)
    {
        $pegawai    = Outst_employee::SelectRaw('outst_employee.* ')
                        ->leftJoin('outstation','outstation.id','=','outst_employee.outstation_id')
                        ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
                        ->where('expenses.id',$id)
                        ->get();
        $pdf = PDF::loadview('finance/travelexpenses.super',compact('pegawai'));
        return $pdf->stream();
    }

}
