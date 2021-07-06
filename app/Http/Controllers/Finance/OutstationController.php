<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Outstation;
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
        $no_sppd = $this->getnosppd();
        $user = User::where('id','!=','1')
                ->get();
        return view('finance/outstation.create',compact('no_sppd','user'));
    }

    function getnosppd(){
        $sppd = Outstation::orderBy('id','desc')->whereYear('created_at',date('Y'))->get(); 
        $first = "001";
        if($sppd->count()>0){
          $first = $sppd->first()->id+1;
          if($first < 10){
              $first = "00".$first;
          }else if($first < 100){
              $first = "0".$first;
          }
        }
        $no_sppd = $first."/SPPD/BBPOM/".date('m')."/".date('Y');
        return $no_sppd;
      }

}
