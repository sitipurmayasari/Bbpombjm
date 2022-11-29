<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;
use LogActivity;
use App\User;
use App\Outstation;
use App\Destination;
use App\Outst_employee;
use App\Outst_destiny;
use App\Pok_detail;
use App\PPK;
use App\Plane;
use App\Budget;
use App\Petugas;
use App\Expenses;
use App\ExpensesUh;
use App\ExpensesTrans;
use App\ExpensesInap;
use App\ExpensesPlane;
use App\Pejabat;
use PDF;

class ReceiptController extends Controller
{
    public function index(Request $request)
    {
        $data = Expenses::orderBy('expenses.updated_at','desc')
                        ->SelectRaw('expenses.*, outstation.number, outstation.purpose')
                        ->leftjoin('outstation','outstation.id','expenses.outstation_id')
                        ->where('jenis','B')
                        ->whereraw('outstation.deleted_at IS null')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('outstation.number','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('outstation.purpose', 'LIKE','%'.$request->keyword.'%');
                        })
                ->paginate('10');
        return view('finance/receipt.index',compact('data'));
    }

    public function create()
    {
        $st = Outstation::WhereRaw('id NOT IN (SELECT outstation_id FROM expenses)')
                        ->orderBy('id','desc')->get();
        return view('finance/receipt.create',compact('st'));
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
         } elseif($desti1->return_date==$desti2->go_date){
            $lama = Outst_destiny::selectRaw('((sum(longday)) - 1) as lawas')
                                    ->where('outstation_id','=',$request->id)
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
            'success' =>true,
            'st'      =>$st,
            'peg'     =>$peg,
            'lama'    =>$lama,
            'dest'      =>$dest,
            'dest2'      =>$dest2,
            'dest3'      =>$dest3,
            'jumltu'  =>$jumlahtujuan
        ],200);
    }

    public function generate(Request $request)
    {
        $this->validate($request,[
            'date'          =>'required',
            'outstation_id' =>'required'
        ]);

        $data = Expenses::create($request->all());
        $rens = $data->id;

        LogActivity::addToLog('Simpan->Kuitansi 2023, nomor = '.$data->st->number);

        return redirect('/finance/receipt/entrydata/'.$rens);
    }


    public function entrydata($id)
    {
        $data   = Expenses::where('id',$id)->first();
        $peg    = Outst_employee::selectRaw('outst_employee.*, users.name,jabatan_id,deskjob')
                                ->leftJoin('users','users.id','=','outst_employee.users_id')
                                ->where('outst_employee.outstation_id',$data->outstation_id)
                                ->get();
        $tujuan = Outst_destiny::selectRaw('outst_destiny.*, destination.capital')
                                ->leftJoin('destination','destination.id','=','outst_destiny.destination_id')
                                ->where('outst_destiny.outstation_id',$data->outstation_id)
                                ->get();
        $plane = Plane::all();

        return view('finance/receipt.entrydata',compact('data','peg','tujuan','plane'));
    }

    public function store(Request $request)
    { 
    
       $id = $request->expenses_id;

      DB::beginTransaction(); 
        
        //ExpensesUh
            for ($i = 0; $i < count($request->input('outst_employee_id')); $i++){
                $data = [
                    'expenses_id'       =>$id,
                    'outst_employee_id' =>$request->outst_employee_id[$i],
                    'tlokalcost'        =>$request->tlokalcost[$i],
                    'tlokalkali'        =>$request->tlokalkali[$i],
                    'tlokalsum'         =>$request->tlokalsum[$i],
                    'uhar1cost'         =>$request->uhar1cost[$i],
                    'uhar1kali'         =>$request->uhar1kali[$i],
                    'uhar1sum'          =>$request->uhar1sum[$i],
                    'uhar2cost'         =>$request->uhar2cost[$i],
                    'uhar2kali'         =>$request->uhar2kali[$i],
                    'uhar2sum'          =>$request->uhar2sum[$i],
                    'uhar3cost'         =>$request->uhar3cost[$i],
                    'uhar3kali'         =>$request->uhar3kali[$i],
                    'uhar3sum'          =>$request->uhar3sum[$i],
                    'diklatcost'        =>$request->diklatcost[$i],
                    'diklatkali'        =>$request->diklatkali[$i],
                    'diklatsum'         =>$request->diklatsum[$i],
                    'fullboardcost'     =>$request->fullboardcost[$i],
                    'fullboardkali'     =>$request->fullboardkali[$i],
                    'fullboardsum'      =>$request->fullboardsum[$i],
                    'fulldaycost'       =>$request->fulldaycost[$i],
                    'fulldaykali'       =>$request->fulldaykali[$i],
                    'fulldaysum'        =>$request->fulldaysum[$i],
                    'repscost'          =>$request->repscost[$i],
                    'repskali'          =>$request->repskali[$i],
                    'repssum'           =>$request->repssum[$i],
                    'halflong'          =>$request->halflong[$i],
                    'halfcost'          =>$request->halfcost[$i],
                    'halfsum'           =>$request->halfsum[$i],
                    'fulllong'          =>$request->fulllong[$i],
                    'fullcost'          =>$request->fullcost[$i],
                    'fullsum'           =>$request->fullsum[$i],
                    'fblong'            =>$request->fblong[$i],
                    'fbcost'            =>$request->fbcost[$i],
                    'fbsum'             =>$request->fbsum[$i],
                  
                ];
                ExpensesUh::create($data);
            }

        //ExpensesTrans
        if ($request->input('outst_employee_id_T') != null) {
            for ($i = 0; $i < count($request->input('outst_employee_id_T')); $i++){

                $emId = $request->barisT[$i];
                $rilltaxi =  $request->input('rilltaxi_'.$emId) != null ?  $request->input('rilltaxi_'.$emId) : 'N';

                $data2 = [
                    'expenses_id'       =>$id,
                    'outst_employee_id' => $request->outst_employee_id_T[$i],
                    'rilltaxi'          => $rilltaxi,
                    'taxitype'          => $request->taxitype[$i],
                    'taxifee'           => $request->taxifee[$i],
                    'taxicount'         => $request->taxicount[$i],
                    'taxisum'           => $request->taxisum[$i],
                    'taxiname'          => $request->taxiname[$i]
                
                ];
                ExpensesTrans::create($data2);
            }
        }
        
         //ExpensesInap
         if ($request->input('outst_employee_id_I') != null) {
            for ($i = 0; $i < count($request->input('outst_employee_id_I')); $i++){
                $emId = $request->barisI[$i];
                $hotelkkp =  $request->input('hotelkkp_'.$emId) != null ?  $request->input('hotelkkp_'.$emId) : 'N';
                $rillhotel =  $request->input('rillhotel_'.$emId) != null ?  $request->input('rillhotel_'.$emId) : 'N';
                $hotelpersen =  $request->input('hotelpersen_'.$emId) != null ?  $request->input('hotelpersen_'.$emId) : 'N';
                $data3 = [
                    'expenses_id'       =>$id,
                    'outst_employee_id' => $request->outst_employee_id_I[$i],
                    'hotelkkp'          => $hotelkkp,
                    'rillhotel'         => $rillhotel,
                    'hotelname'         => $request->hotelname[$i],
                    'hoteladdr'         => $request->hoteladdr[$i],
                    'hoteltelp'         => $request->hoteltelp[$i],
                    'hotelroom'         => $request->hotelroom[$i],
                    'hotelin'           => $request->hotelin[$i],
                    'hotelout'          => $request->hotelout[$i],
                    'hotelmax'          => $request->hotelmax[$i],
                    'hotelfee'          => $request->hotelfee[$i],
                    'hotellong'         => $request->hotellong[$i],
                    'person'            => $request->person[$i],
                    'hotelsum'          => $request->hotelsum[$i],
                    'hotelinfo'         => $request->hotelinfo[$i],
                    'hotelpersen'       => $hotelpersen
                
                ];
                ExpensesInap::create($data3);
            }
         }

         //ExpensesPlane
         if ($request->input('outst_employee_id_P') != null) {
            for ($i = 0; $i < count($request->input('outst_employee_id_P')); $i++){
                $plId = $request->barisP[$i];
                $planekkp =  $request->input('planekkp_'.$plId) != null ?  $request->input('planekkp_'.$plId) : 'N';

                $data4 = [
                        'expenses_id'       => $id,
                        'outst_employee_id' => $request->outst_employee_id_P[$i],
                        'plane_id'          => $request->plane_id[$i],   
                        'planekkp'          => $planekkp,
                        'ticketnumber'      => $request->ticketnumber[$i],
                        'ticketfee'         => $request->ticketfee[$i],
                        'ticketdate'        => $request->ticketdate[$i],
                        'bookingcode'       => $request->bookingcode[$i],
                        'flightnumber'      => $request->flightnumber[$i],
                        'planetype'         => $request->planetype[$i]
                
                ];
                ExpensesTrans::create($data4);
            }
        }

        DB::commit();

        return redirect('/finance/receipt');
    }

    public function edit($id)
    {
        $data   = Expenses::where('id',$id)->first();
        $peg    = Outst_employee::selectRaw('outst_employee.*, users.name,jabatan_id,deskjob')
                                ->leftJoin('users','users.id','=','outst_employee.users_id')
                                ->where('outst_employee.outstation_id',$data->outstation_id)
                                ->get();
        $tujuan = Outst_destiny::selectRaw('outst_destiny.*, destination.capital')
                                ->leftJoin('destination','destination.id','=','outst_destiny.destination_id')
                                ->where('outst_destiny.outstation_id',$data->outstation_id)
                                ->get();
        $lama   = Outst_destiny::SelectRaw('SUM(longday) as lamahari')
                                ->where('outstation_id',$data->outstation_id)->first();
        $plane = Plane::all();
        $uangharian = ExpensesUh::where('expenses_id',$id)->orderby('id','asc')->get();
        $uangtransport = ExpensesTrans::where('expenses_id',$id)->orderby('id','asc')->get();
        $uangplane = ExpensesPlane::where('expenses_id',$id)->orderby('id','asc')->get();
        $uanginn = ExpensesInap::where('expenses_id',$id)->orderby('id','asc')->get();

        return view('finance/receipt.edit',compact('data','peg','tujuan','plane','uangplane','uangharian','uangtransport','uanginn','lama'));
    }

    public function deletetr($id)
    {
        $data = ExpensesTrans::find($id);
        $x  = Expenses::where('id',$data->expenses_id)->first();

        $data->delete();
        return redirect('finance/receipt/edit/'.$x)->with('sukses','Transport Terhapus');
    }

    public function deleteplane($id)
    {
        $data = ExpensesPlane::find($id);
        $x  = Expenses::where('id',$data->expenses_id)->first();
        $data->delete();
        return redirect('finance/receipt/edit/'.$x)->with('sukses','Transport Terhapus');
    }

    public function deleteinn($id)
    {
        $data = ExpensesInap::find($id);
        $x  = Expenses::where('id',$data->expenses_id)->first();
        $data->delete();
        return redirect('finance/receipt/edit/'.$x)->with('sukses','Transport Terhapus');
    }

    public function update(Request $request,$id)
    { 
        // dd($request->all());
        $expenses = Expenses::find($id);
        $expenses->touch();

        DB::beginTransaction(); 
            $expenses = Outstation::find($id);
            $expenses->update($request->all());

            ExpensesUh::where('expenses_id', $id)->delete();
            ExpensesTrans::where('expenses_id', $id)->delete();
            ExpensesInap::where('expenses_id', $id)->delete();
            ExpensesPlane::where('expenses_id', $id)->delete();
        
        //ExpensesUh
            for ($i = 0; $i < count($request->input('outst_employee_id')); $i++){
                $data = [
                    'expenses_id'       =>$id,
                    'outst_employee_id' =>$request->outst_employee_id[$i],
                    'tlokalcost'        =>$request->tlokalcost[$i],
                    'tlokalkali'        =>$request->tlokalkali[$i],
                    'tlokalsum'         =>$request->tlokalsum[$i],
                    'uhar1cost'         =>$request->uhar1cost[$i],
                    'uhar1kali'         =>$request->uhar1kali[$i],
                    'uhar1sum'          =>$request->uhar1sum[$i],
                    'uhar2cost'         =>$request->uhar2cost[$i],
                    'uhar2kali'         =>$request->uhar2kali[$i],
                    'uhar2sum'          =>$request->uhar2sum[$i],
                    'uhar3cost'         =>$request->uhar3cost[$i],
                    'uhar3kali'         =>$request->uhar3kali[$i],
                    'uhar3sum'          =>$request->uhar3sum[$i],
                    'diklatcost'        =>$request->diklatcost[$i],
                    'diklatkali'        =>$request->diklatkali[$i],
                    'diklatsum'         =>$request->diklatsum[$i],
                    'fullboardcost'     =>$request->fullboardcost[$i],
                    'fullboardkali'     =>$request->fullboardkali[$i],
                    'fullboardsum'      =>$request->fullboardsum[$i],
                    'fulldaycost'       =>$request->fulldaycost[$i],
                    'fulldaykali'       =>$request->fulldaykali[$i],
                    'fulldaysum'        =>$request->fulldaysum[$i],
                    'repscost'          =>$request->repscost[$i],
                    'repskali'          =>$request->repskali[$i],
                    'repssum'           =>$request->repssum[$i],
                    'halflong'          =>$request->halflong[$i],
                    'halfcost'          =>$request->halfcost[$i],
                    'halfsum'           =>$request->halfsum[$i],
                    'fulllong'          =>$request->fulllong[$i],
                    'fullcost'          =>$request->fullcost[$i],
                    'fullsum'           =>$request->fullsum[$i],
                    'fblong'            =>$request->fblong[$i],
                    'fbcost'            =>$request->fbcost[$i],
                    'fbsum'             =>$request->fbsum[$i],
                  
                ];
                ExpensesUh::create($data);
            }

        //ExpensesTrans
        if ($request->input('outst_employee_id_T') != null) {
            for ($i = 0; $i < count($request->input('outst_employee_id_T')); $i++){
                $trId = $request->barisT[$i];
                $rilltaxi =  $request->input('rilltaxi_'.$trId) != null ?  $request->input('rilltaxi_'.$trId) : 'N';

                $data2 = [
                    'expenses_id'       => $id,
                    'outst_employee_id' => $request->outst_employee_id_T[$i],
                    'rilltaxi'          => $rilltaxi,
                    'taxitype'          => $request->taxitype[$i],
                    'taxifee'           => $request->taxifee[$i],
                    'taxicount'         => $request->taxicount[$i],
                    'taxisum'           => $request->taxisum[$i],
                    'taxiname'          => $request->taxiname[$i]
                
                ];
                ExpensesTrans::create($data2);
            }
        }
        
         //ExpensesInap
         if ($request->input('outst_employee_id_I') != null) {
            for ($i = 0; $i < count($request->input('outst_employee_id_I')); $i++){
                $InId = $request->barisI[$i];
                $hotelkkp =  $request->input('hotelkkp_'.$InId) != null ?  $request->input('hotelkkp_'.$InId) : 'N';
                $rillhotel =  $request->input('rillhotel_'.$InId) != null ?  $request->input('rillhotel_'.$InId) : 'N';
                $hotelpersen =  $request->input('hotelpersen_'.$InId) != null ?  $request->input('hotelpersen_'.$InId) : 'N';

                $data3 = [
                    'expenses_id'       => $id,
                    'outst_employee_id' => $request->outst_employee_id_I[$i],
                    'hotelkkp'          => $hotelkkp,
                    'rillhotel'         => $rillhotel,
                    'hotelname'         => $request->hotelname[$i],
                    'hoteladdr'         => $request->hoteladdr[$i],
                    'hoteltelp'         => $request->hoteltelp[$i],
                    'hotelroom'         => $request->hotelroom[$i],
                    'hotelin'           => $request->hotelin[$i],
                    'hotelout'          => $request->hotelout[$i],
                    'hotelmax'          => $request->hotelmax[$i],
                    'hotelfee'          => $request->hotelfee[$i],
                    'hotellong'         => $request->hotellong[$i],
                    'person'            => $request->person[$i],
                    'hotelsum'          => $request->hotelsum[$i],
                    'hotelinfo'         => $request->hotelinfo[$i],
                    'hotelpersen'       => $hotelpersen
                
                ];
                ExpensesInap::create($data3);
            }
         }

         //ExpensesPlane
         if ($request->input('outst_employee_id_P') != null) {
            for ($i = 0; $i < count($request->input('outst_employee_id_P')); $i++){
                $plId = $request->barisP[$i];
                $planekkp =  $request->input('planekkp_'.$plId) != null ?  $request->input('planekkp_'.$plId) : 'N';

                $data4 = [
                    'expenses_id'       => $id,
                        'outst_employee_id' => $request->outst_employee_id_P[$i],
                        'plane_id'          => $request->plane_id[$i],   
                        'planekkp'          => $planekkp,
                        'ticketnumber'      => $request->ticketnumber[$i],
                        'ticketfee'         => $request->ticketfee[$i],
                        'ticketdate'        => $request->ticketdate[$i],
                        'bookingcode'       => $request->bookingcode[$i],
                        'flightnumber'      => $request->flightnumber[$i],
                        'planetype'         => $request->planetype[$i]
                
                ];
                ExpensesPlane::create($data4);
            }
        }
        DB::commit();
        $log = Expenses::where('id',$id)->first();
        LogActivity::addToLog('Ubah->Kuitansi 2023, nomor = '.$log->st->number);
        return redirect('/finance/receipt');
    }

    public function cost($id)
    { 
        $data = Expenses::where('id',$id)->first();
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
        $petugas    = Petugas::where('id', '=', 5)->first();
       

        if ($tipe->type=="DL") {
            $pdf        = PDF::loadview('finance/receipt.costDK',compact('petugas','data','pegawai','tujuan'));
            return $pdf->stream();

        } else {
            return view('finance/receipt.costLK',compact('petugas','data','pegawai','tujuan'));
        }

        
    }

    public function super30($id)
    {
        $data       = Expenses::where('id',$id)->first();
        $inap       = ExpensesInap::where('hotelpersen','Y')
                                    ->where('expenses_id',$id)
                                    ->get();
        $petugas    = Petugas::where('id', 7)->first();
        $tujuan    = Outst_destiny::SelectRaw('outst_destiny.* ')
        ->leftJoin('outstation','outstation.id','=','outst_destiny.outstation_id')
        ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
        ->where('expenses.id',$id)
        ->get();
        $pdf = PDF::loadview('finance/receipt.super30',compact('data','inap','petugas','tujuan'));
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
        $pdf = PDF::loadview('finance/receipt.super',compact('data','pegawai','tujuan'));
        return $pdf->stream();
    }

    public function riilkkp($id)
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
        
        $desti1   = Outst_destiny::orderBy('outst_destiny.id','asc')
                                ->leftJoin('outstation','outstation.id','=','outst_destiny.outstation_id')
                                ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
                                ->where('expenses.id',$id)
                                ->first();
        $desti2   = Outst_destiny::orderBy('outst_destiny.id','desc')
                                ->leftJoin('outstation','outstation.id','=','outst_destiny.outstation_id')
                                ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
                                ->where('expenses.id',$id)
                                ->first();

        if ($desti1->go_date==$desti2->go_date) {
            $lama = Outst_destiny::selectRaw('longday as hitung')
                                  ->where('outstation_id','=',$desti1->outstation_id)
                                  ->first();
        } else {
            $lama = Outst_destiny::selectRaw('sum(longday) as hitung')
                                  ->where('outstation_id','=',$desti1->outstation_id)
                                  ->first();
        }
                        
        $pdf = PDF::loadview('finance/receipt.riilkkp',compact('petugas','data','pegawai','tujuan','lama'));
        return $pdf->stream();
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
        
        $desti1   = Outst_destiny::orderBy('outst_destiny.id','asc')
                                ->leftJoin('outstation','outstation.id','=','outst_destiny.outstation_id')
                                ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
                                ->where('expenses.id',$id)
                                ->first();
        $desti2   = Outst_destiny::orderBy('outst_destiny.id','desc')
                                ->leftJoin('outstation','outstation.id','=','outst_destiny.outstation_id')
                                ->leftJoin('expenses','expenses.outstation_id','=','outstation.id')
                                ->where('expenses.id',$id)
                                ->first();

        if ($desti1->go_date==$desti2->go_date) {
            $lama = Outst_destiny::selectRaw('longday as hitung')
                                  ->where('outstation_id','=',$desti1->outstation_id)
                                  ->first();
        } else {
            $lama = Outst_destiny::selectRaw('sum(longday) as hitung')
                                  ->where('outstation_id','=',$desti1->outstation_id)
                                  ->first();
        }
                        
        $pdf = PDF::loadview('finance/receipt.riil',compact('petugas','data','pegawai','tujuan','lama'));
        return $pdf->stream();
    }

    public function delete($id)
    {

        $data = Expenses::find($id);
        LogActivity::addToLog('Simpan->Kuitansi 2023, nomor = '.$data->st->number);

        $daily = ExpensesUh::where('expenses_id',$id);
        $daily->delete();

        $tr = ExpensesTrans::where('expenses_id',$id);
        $tr->delete();

        $tr1 = ExpensesInap::where('expenses_id',$id);
        $tr1->delete();

        $tr2 = ExpensesPlane::where('expenses_id',$id);
        $tr2->delete();

        $data->delete();

        return redirect('/finance/receipt')->with('sukses','Data Terhapus');
    }

    public function nominatif($id)
    {
        $data       = Expenses::where('id',$id)->first();
        
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
        $harian     = ExpensesUh::where('expenses_id',$id)->get();
        $pdf = PDF::loadview('finance/receipt.nominatif',compact('data','tujuan','menyetujui','harian'));
        return $pdf->stream();

    }



}
