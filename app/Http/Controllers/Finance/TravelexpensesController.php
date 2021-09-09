<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Destination;
use App\Outstation;
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
                ->select('outstation.*','users.name')
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

    //   public function printST()
    //   {
    //       $pdf = PDF::loadview('finance/travelexpenses.printST');
    //       return $pdf->stream();
    //   }

    //   public function printSppd()
    //   {
    //       $pdf = PDF::loadview('finance/travelexpenses.printSppd');
    //       return $pdf->stream();
    //   }

}
