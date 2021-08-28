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


class OutstationController extends Controller
{

    public function index(Request $request)
    {
        $data = Outstation::orderBy('id','desc')
                ->select('outstation.*','users.name')
                ->leftJoin('users','users.id','=','outstation.users_id')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('outstation.code','LIKE','%'.$request->keyword.'%')
                            ->orWhere('outstation.name', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('destination', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('finance/outstation.index',compact('data'));
    }

    public function create()
    {
        $plane = Plane::all();
        $car = Car::all();
        $ppk = PPK::all();
        $budget = Budget::all();
        $pok = Pok_detail::selectRaw('DISTINCT(subcode_id),accountcode_id')->get();
        $div = Divisi::all();
        $no_st = $this->getnost();
        $user = User::where('id','!=','1')->get();
        $driver = User::where('deskjob','LIKE','%Sopir%')->get();
        $destination = Destination::all();
        return view('finance/outstation.create',compact('user','destination','no_st','div','pok','ppk','plane','driver',
        'car','budget'));
    }

    function getnost(){
        $sppd = Outstation::orderBy('id','desc')->whereYear('created_at',date('Y'))->get(); 
        $bidang = Divisi::select('lokasi')->where('id','2')->first();
        $first = "0001";
        if($sppd->count()>0){
          $first = $sppd->first()->id+1;
          if($first < 10){
              $first = "000".$first;
          }else if($first < 100){
              $first = "00".$first;
          }else if($first < 1000){
            $first = "0".$first;
        }
        }
        $no_sppd = "RT.02.01.".$bidang->lokasi.".".date('m').".".date('y').".".$first;
        return $no_sppd;
      }


      public function printST()
      {
          $pdf = PDF::loadview('finance/outstation.printST');
          return $pdf->stream();
      }

      public function printSppd()
      {
          $pdf = PDF::loadview('finance/outstation.printSppd');
          return $pdf->stream();
      }

}
