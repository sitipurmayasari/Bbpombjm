<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Destination;
use App\Outstation;
use App\Outst_employee;
use App\Divisi;
use App\Pok_detail;
use App\PPK;
use App\Plane;
use App\Car;
use App\Budget;
use PDF;



class TravelexpensesController extends Controller
{

    public function index(Request $request)
    {
        $data = Outstation::orderBy('id','desc')
                ->select('outstation.*')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('number','LIKE','%'.$request->keyword.'%')
                            ->orWhere('purpose', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('st_date', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('finance/travelexpenses.index',compact('data'));
    }

    public function create()
    {
        $st = Outstation::all();
        $pok = Pok_detail::selectRaw('DISTINCT(subcode_id),accountcode_id')->get();
        $plane = Plane::all();
        $car = Car::all();
        $user = User::where('id','!=','1')->get();
        $driver = User::where('deskjob','LIKE','%Sopir%')->get();

        return view('finance/travelexpenses.create',compact('user','st','plane','driver','car','pok'));
    }

    function getMaksud(Request $request){
        $st = Outstation::where('id',$request->id)->first();
        $peg = Outst_employee::selectRaw('outst_employee.*, users.name')
                ->leftJoin('users','users.id','=','outst_employee.users_id')
                ->where('outst_employee.outstation_id',$request->id)->get();

        return response()->json([ 
            'success'   => true,
            'st'        =>$st,
            'peg'       =>$peg
        ],200);
    }

    //   public function printST()
    //   {
    //       $pdf = PDF::loadview('finance/travelexpenses.printST');
    //       return $pdf->stream();
    //   }

}
