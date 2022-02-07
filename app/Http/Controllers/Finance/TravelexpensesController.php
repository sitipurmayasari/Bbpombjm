<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;
use App\Expenses_daily;
use App\Travelexpenses;
use App\Travelexpenses1;
use App\Travelexpenses2;
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
        $st = Outstation::WhereRaw('id NOT IN (SELECT outstation_id FROM expenses)')
                        ->orderBy('id','desc')->get();
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
        $jumlahtujuan =  Outst_destiny::SelectRaw('count(*) as hitung')   
                                ->where('outstation_id',$request->id)
                                ->first(); 
        //-------------------------------------------------------------------------------
        $desti1   = Outst_destiny::orderBy('outst_destiny.id','asc')
                                    ->leftJoin('destination','destination.id','=','outst_destiny.destination_id')
                                    ->where('outst_destiny.outstation_id',$request->id)
                                    ->first();  
        $desti2   = Outst_destiny::orderBy('outst_destiny.id','desc')
                                    ->leftJoin('destination','destination.id','=','outst_destiny.destination_id')
                                    ->where('outst_destiny.outstation_id',$request->id)
                                    ->first();  
        if ($desti1->go_date==$desti2->go_date) {
            $lama   = Outst_destiny::selectRaw('longday as lawas')
                                    ->where('outstation_id',$request->id)
                                    ->first();
        } else {
            $lama   = Outst_destiny::selectRaw('sum(longday) as lawas')
                                ->where('outstation_id',$request->id)
                                ->first();
        }
        
                                
        $dest   = Destination::WhereRaw('id = (SELECT destination_id FROM outst_destiny WHERE outstation_id ='.$request->id.'
                                        ORDER BY id ASC limit 1) ')
                                ->first();
        $dest2   = Destination::WhereRaw('id = (SELECT destination_id FROM
                                                    (SELECT * FROM outst_destiny where outstation_id ='.$request->id.'
                                                        ORDER BY id desc LIMIT 2) INI
                                                LIMIT 1) ')
                                ->first();
        $dest3   = Destination::WhereRaw('id = (SELECT destination_id FROM outst_destiny WHERE outstation_id ='.$request->id.'
                                ORDER BY id DESC limit 1) ')
                                ->first();

        return response()->json([ 
            'success'   => true,
            'st'        =>$st,
            'peg'       =>$peg,
            'lama'      =>$lama,
            'dest'      =>$dest,
            'dest2'      =>$dest2,
            'dest3'      =>$dest3,
            'jumltu'    =>$jumlahtujuan
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
        //metadata
            $expenses = Expenses::create($request->all());
            $expenses_id = $expenses->id;
        
        //Expenses_daily
            for ($i = 0; $i < count($request->input('outst_employee_id')); $i++){
                $dailywage1      = $request->dailywage1 != null ?  $request->dailywage1[$i] : 'N';
                $dailywage2      = $request->dailywage2 != null ?  $request->dailywage2[$i] : 'N';
                $dailywage3      = $request->dailywage3 != null ?  $request->dailywage3[$i] : 'N';

                $data = [
                    'expenses_id'       => $expenses_id,
                    'outst_employee_id' => $request->outst_employee_id[$i],
                    'dailywage1'        => $dailywage1,
                    'dailywage2'        => $dailywage2,
                    'dailywage3'        => $dailywage3,
                    'hitdaily1'         => $request->hitdaily1[$i],
                    'jumdaily1'         => $request->jumdaily1[$i],
                    'totdaily1'         => $request->totdaily1[$i],
                    'hitdaily2'         => $request->hitdaily2[$i],
                    'jumdaily2'         => $request->jumdaily2[$i],
                    'totdaily2'         => $request->totdaily2[$i],
                    'hitdaily3'         => $request->hitdaily3[$i],
                    'jumdaily3'         => $request->jumdaily3[$i],
                    'totdaily3'         => $request->totdaily3[$i],
                  
                ];
                Expenses_daily::create($data);
            }

            //Travelexpenses
            for ($i = 0; $i < count($request->input('outst_employee_id')); $i++){
                $diklat         = $request->diklat != null ?  $request->diklat[$i] : 'N';
                $fullboard      = $request->fullboard != null ?  $request->fullboard[$i] : 'N';
                $fullday        = $request->fullday != null ?  $request->fullday[$i] : 'N';
                $representatif  = $request->representatif != null ?  $request->representatif[$i] : 'N';

                $dataone = [
                    'expenses_id'       => $expenses_id,
                    'outst_employee_id' => $request->outst_employee_id[$i],
                    'diklat'            => $diklat,
                    'fullboard'         => $fullboard,
                    'fullday'           => $fullday,
                    'representatif'     => $representatif,
                    'hitdiklat'         => $request->hitdiklat[$i],
                    'jumdiklat'         => $request->jumdiklat[$i],
                    'totdiklat'         => $request->totdiklat[$i],
                    'hitfullb'          => $request->hitfullb[$i],
                    'jumfullb'          => $request->jumfullb[$i],
                    'totfullb'          => $request->totfullb[$i],
                    'hithalf'           => $request->hithalf[$i],
                    'jumhalf'           => $request->jumhalf[$i],
                    'tothalf'           => $request->tothalf[$i],
                    'hitrep'            => $request->hitrep[$i],
                    'jumrep'            => $request->jumrep[$i],
                    'totrep'            => $request->totrep[$i],
                    'dayshalf'          => $request->dayshalf[$i],
                    'feehalf'           => $request->feehalf[$i],
                    'totdayshalf'       => $request->totdayshalf[$i],
                    'daysfull'          => $request->daysfull[$i],
                    'feefull'           => $request->feefull[$i],
                    'totdayshalf'       => $request->totdayshalf[$i]
                ];
                Travelexpenses::create($dataone);
            }

            //Travelexpenses1
            for ($i = 0; $i < count($request->input('outst_employee_id')); $i++){
                $datatwo = [
                    'expenses_id'       => $expenses_id,
                    'outst_employee_id' => $request->outst_employee_id[$i],
                    'innname_1'         => $request->innname_1[$i],
                    'inn_fee_1'         => $request->inn_fee_1[$i],
                    'long_stay_1'       => $request->long_stay_1[$i],
                    'isi_1'             => $request->isi_1[$i],
                    'klaim_1'           => $request->klaim_1[$i],
                    'innname_2'         => $request->innname_2[$i],
                    'inn_fee_2'         => $request->inn_fee_2[$i],
                    'long_stay_2'       => $request->long_stay_2[$i],
                    'isi_2'             => $request->isi_2[$i],
                    'klaim_2'           => $request->klaim_2[$i],
                    'bbm'               => $request->bbm[$i],
                    'taxy_count_from'   => $request->taxy_count_from[$i],
                    'taxy_fee_from'     => $request->taxy_fee_from[$i],
                    'taxy_count_to'     => $request->taxy_count_to[$i],
                    'taxy_fee_to'       => $request->taxy_fee_to[$i],
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

            //Travelexpenses2
            for ($i = 0; $i < count($request->input('outst_employee_id')); $i++){
                $datathree = [
                    'expenses_id'       => $expenses_id,
                    'outst_employee_id' => $request->outst_employee_id[$i],
                    'inn_loc1'          => $request->inn_loc1[$i],
                    'inn_loc2'          => $request->inn_loc2[$i],
                    'inn_telp1'         => $request->inn_telp1[$i],
                    'inn_telp2'         => $request->inn_telp2[$i],
                    'checkin1'          => $request->checkin1[$i],
                    'checkin2'          => $request->checkin2[$i],
                    'checkout1'         => $request->checkout1[$i],
                    'checkout2'         => $request->checkout2[$i],
                    'inn_room1'         => $request->inn_room1[$i],
                    'inn_room2'         => $request->inn_room2[$i],
                    'innvoice1'         => $request->innvoice1[$i],
                    'innvoice2'         => $request->innvoice2[$i],
                    'plane_book1'       => $request->plane_book1[$i],
                    'plane_book2'       => $request->plane_book2[$i],
                    'plane_book3'       => $request->plane_book3[$i],
                    'plane_bookreturn'  => $request->plane_bookreturn[$i],
                    'plane_flight1'     => $request->plane_flight1[$i],
                    'plane_flight2'     => $request->plane_flight2[$i],
                    'plane_flight3'     => $request->plane_flight3[$i],
                    'plane_flightreturn'=> $request->plane_flightreturn[$i],
                ];
                Travelexpenses2::create($datathree);     
            }

        DB::commit();

        return redirect('/finance/travelexpenses');

    }

    public function edit($id)
    {
        $pok = Pok_detail::selectRaw('DISTINCT(subcode_id),accountcode_id')->get();
        $plane = Plane::all();
        $user = User::where('id','!=','1')->get();
        $data   = Expenses::where('id',$id)->first();
        $tujuan = Outst_destiny::where('outstation_id',$data->outstation_id)->get();
        $lama   = Outst_destiny::SelectRaw('SUM(longday) as lamahari')
                            ->where('outstation_id',$data->outstation_id)->first();
        return view('finance/travelexpenses.edit',compact('data','pok','plane','user','data','tujuan','lama'));
    }


    function getIsian(Request $request){
        $expen = Expenses_daily::SelectRaw('expenses_daily.*, users.name')
                                ->LeftJoin('outst_employee','expenses_daily.outst_employee_id','=','outst_employee.id')
                                ->LeftJoin('users','users.id','=','outst_employee.users_id')
                                ->where('expenses_id',$request->id)
                                ->get();
        $expen1 = Travelexpenses::SelectRaw('travelexpenses.*, users.name')
                                ->LeftJoin('outst_employee','travelexpenses.outst_employee_id','=','outst_employee.id')
                                ->LeftJoin('users','users.id','=','outst_employee.users_id')
                                ->where('expenses_id',$request->id)
                                ->get();
        $expen2 = Travelexpenses1::SelectRaw('travelexpenses1.*, users.name,inn_loc1,inn_telp1,checkin1,checkout1,inn_room1, innvoice1,inn_loc2,inn_telp2,checkin2,checkout2,inn_room2,innvoice2,plane_book1,plane_flight1,plane_book2,plane_flight2,plane_book3,plane_flight3,plane_bookreturn,plane_flightreturn')
                                ->LeftJoin('outst_employee','travelexpenses1.outst_employee_id','=','outst_employee.id')
                                ->leftjoin('travelexpenses2','travelexpenses2.outst_employee_id','=','travelexpenses1.outst_employee_id')
                                ->LeftJoin('users','users.id','=','outst_employee.users_id')
                                ->where('travelexpenses1.expenses_id',$request->id)
                                ->get();



        return response()->json([ 
            'success'   => true,
            'expen'       =>$expen,
            'expen1'      =>$expen1,
            'expen2'      =>$expen2
        ],200);
    }


    public function update(Request $request,$id)
    {
        // dd($request->all());
        DB::beginTransaction();
            Expenses_daily::where('Expenses_id', $id)->delete();
            Travelexpenses::where('Expenses_id', $id)->delete();
            Travelexpenses1::where('Expenses_id', $id)->delete();
            Travelexpenses2::where('Expenses_id', $id)->delete();
            $expenses_id = $id;

            for ($i = 0; $i < count($request->input('outst_employee_id')); $i++){
                $dailywage1      = $request->dailywage1 != null ?  $request->dailywage1[$i] : 'N';
                $dailywage2      = $request->dailywage2 != null ?  $request->dailywage2[$i] : 'N';
                $dailywage3      = $request->dailywage3 != null ?  $request->dailywage3[$i] : 'N';

                $data = [
                    'expenses_id'       => $expenses_id,
                    'outst_employee_id' => $request->outst_employee_id[$i],
                    'dailywage1'        => $dailywage1,
                    'dailywage2'        => $dailywage2,
                    'dailywage3'        => $dailywage3,
                    'hitdaily1'         => $request->hitdaily1[$i],
                    'jumdaily1'         => $request->jumdaily1[$i],
                    'totdaily1'         => $request->totdaily1[$i],
                    'hitdaily2'         => $request->hitdaily2[$i],
                    'jumdaily2'         => $request->jumdaily2[$i],
                    'totdaily2'         => $request->totdaily2[$i],
                    'hitdaily3'         => $request->hitdaily3[$i],
                    'jumdaily3'         => $request->jumdaily3[$i],
                    'totdaily3'         => $request->totdaily3[$i],
                  
                ];
                Expenses_daily::create($data);
            }

            for ($i = 0; $i < count($request->input('outst_employee_id')); $i++){
                $nomor = $i+1;
                $diklat         = $request->diklat != null ?  $request->diklat[$i] : 'N';
                $fullboard      = $request->fullboard != null ?  $request->fullboard[$i] : 'N';
                $fullday        = $request->fullday != null ?  $request->fullday[$i] : 'N';
                $representatif  = $request->representatif != null ?  $request->representatif[$i] : 'N';

                $dataone = [
                    'expenses_id'       => $expenses_id,
                    'outst_employee_id' => $request->outst_employee_id[$i],
                    'diklat'            => $diklat,
                    'fullboard'         => $fullboard,
                    'fullday'           => $fullday,
                    'representatif'     => $representatif,
                    'hitdiklat'         => $request->hitdiklat[$i],
                    'jumdiklat'         => $request->jumdiklat[$i],
                    'totdiklat'         => $request->totdiklat[$i],
                    'hitfullb'          => $request->hitfullb[$i],
                    'jumfullb'          => $request->jumfullb[$i],
                    'totfullb'          => $request->totfullb[$i],
                    'hithalf'           => $request->hithalf[$i],
                    'jumhalf'           => $request->jumhalf[$i],
                    'tothalf'           => $request->tothalf[$i],
                    'hitrep'            => $request->hitrep[$i],
                    'jumrep'            => $request->jumrep[$i],
                    'totrep'            => $request->totrep[$i],
                    'dayshalf'          => $request->dayshalf[$i],
                    'feehalf'           => $request->feehalf[$i],
                    'totdayshalf'       => $request->totdayshalf[$i],
                    'daysfull'          => $request->daysfull[$i],
                    'feefull'           => $request->feefull[$i],
                    'totdayshalf'       => $request->totdayshalf[$i],
                    
                ];
                $dokument = Travelexpenses::create($dataone);

                if($request->hasFile('file-'.$nomor)){ // Kalau file ada
                    $request->file('file-'.$nomor)
                                ->move('images/kuitansi/'.$dokument->id,$request
                                ->file('file-'.$nomor)
                                ->getClientOriginalName()); 
                    $dokument->file = $request->file('file-'.$nomor)->getClientOriginalName(); 
                    $dokument->save(); 
                }
            }

            
            for ($i = 0; $i < count($request->input('outst_employee_id')); $i++){
                $datatwo = [
                    'expenses_id'       => $expenses_id,
                    'outst_employee_id' => $request->outst_employee_id[$i],
                    'innname_1'         => $request->innname_1[$i],
                    'inn_fee_1'         => $request->inn_fee_1[$i],
                    'long_stay_1'       => $request->long_stay_1[$i],
                    'isi_1'             => $request->isi_1[$i],
                    'klaim_1'           => $request->klaim_1[$i],
                    'innname_2'         => $request->innname_2[$i],
                    'inn_fee_2'         => $request->inn_fee_2[$i],
                    'long_stay_2'       => $request->long_stay_2[$i],
                    'isi_2'             => $request->isi_2[$i],
                    'klaim_2'           => $request->klaim_2[$i],
                    'bbm'               => $request->bbm[$i],
                    'taxy_count_from'   => $request->taxy_count_from[$i],
                    'taxy_fee_from'     => $request->taxy_fee_from[$i],
                    'taxy_count_to'     => $request->taxy_count_to[$i],
                    'taxy_fee_to'     => $request->taxy_fee_to[$i],
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

            //Travelexpenses2
            for ($i = 0; $i < count($request->input('outst_employee_id')); $i++){
                $datathree = [
                    'expenses_id'       => $expenses_id,
                    'outst_employee_id' => $request->outst_employee_id[$i],
                    'inn_loc1'          => $request->inn_loc1[$i],
                    'inn_loc2'          => $request->inn_loc2[$i],
                    'inn_telp1'         => $request->inn_telp1[$i],
                    'inn_telp2'         => $request->inn_telp2[$i],
                    'checkin1'          => $request->checkin1[$i],
                    'checkin2'          => $request->checkin2[$i],
                    'checkout1'         => $request->checkout1[$i],
                    'checkout2'         => $request->checkout2[$i],
                    'inn_room1'         => $request->inn_room1[$i],
                    'inn_room2'         => $request->inn_room2[$i],
                    'innvoice1'         => $request->innvoice1[$i],
                    'innvoice2'         => $request->innvoice2[$i],
                    'plane_book1'       => $request->plane_book1[$i],
                    'plane_book2'       => $request->plane_book2[$i],
                    'plane_book3'       => $request->plane_book3[$i],
                    'plane_bookreturn'  => $request->plane_bookreturn[$i],
                    'plane_flight1'     => $request->plane_flight1[$i],
                    'plane_flight2'     => $request->plane_flight2[$i],
                    'plane_flight3'     => $request->plane_flight3[$i],
                    'plane_flightreturn'=> $request->plane_flightreturn[$i],
                ];
                Travelexpenses2::create($datathree);    
            }

            DB::commit();

        return redirect('/finance/travelexpenses')->with('sukses','Data Berhasil Diperbaharui');

    }


    public function receipt($id)
    {
        $data       = Expenses::where('id',$id)->first();
        $pegawai    = Outst_employee::SelectRaw('outst_employee.*, outstation.type')
                                    ->leftJoin('outstation','outstation.id','=','outst_employee.outstation_id')
                                    ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
                                    ->where('expenses.id',$id)
                                    ->get();
        $tujuan    = Outst_destiny::SelectRaw('outst_destiny.* ')
                                    ->leftJoin('outstation','outstation.id','=','outst_destiny.outstation_id')
                                    ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
                                    ->where('expenses.id',$id)
                                    ->get();
        $tipe       = Outst_employee::SelectRaw('outst_employee.*, outstation.type')
                                    ->leftJoin('outstation','outstation.id','=','outst_employee.outstation_id')
                                    ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
                                    ->where('expenses.id',$id)
                                    ->first();
        $jmltujuan  = Outst_destiny::SelectRaw('count(*) as hitung')   
                                    ->leftJoin('outstation','outstation.id','=','outst_destiny.outstation_id')
                                    ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
                                    ->where('expenses.id',$id)
                                    ->first(); 
        $tr         = Expenses_daily::where('expenses_id',$id)->get();
        $petugas    = Petugas::where('id', '=', 5)->first();
       

        if ($tipe->type=="DL") {
            $pdf        = PDF::loadview('finance/travelexpenses.receiptdL',compact('petugas','data','pegawai','tujuan','tr'));
            return $pdf->stream();

        } else {
            // return view('finance/travelexpenses.receipt',compact('petugas','data','pegawai','tujuan'));
           if ($jmltujuan->hitung == 1) {
                $pdf        = PDF::loadview('finance/travelexpenses.receipt',compact('petugas','data','pegawai','tujuan'));
                return $pdf->stream();
           } else {
                $pdf        = PDF::loadview('finance/travelexpenses.receiptpdf',compact('petugas','data','pegawai','tujuan'));
                return $pdf->stream();
           }
           
        }
        
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
        $pdf = PDF::loadview('finance/travelexpenses.super',compact('data','pegawai','tujuan'));
        return $pdf->stream();
    }


    public function delete($id)
    {
        $lokasi = Expenses::find($id);
        $lokasi->delete();

        $daily = Expenses_daily::where('expenses_id',$id);
        $daily->delete();

        $tr = Travelexpenses::where('expenses_id',$id);
        $tr->delete();

        $tr1 = Travelexpenses1::where('expenses_id',$id);
        $tr1->delete();
        return redirect('/finance/travelexpenses')->with('sukses','Data Terhapus');
    }

}
