<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Car;
use App\User;
use App\Outstation;
use App\Pejabat;
use App\Vehiclerent;
use PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CarrentController extends Controller
{

    public function index(Request $request)
    {   
        $data = Vehiclerent::orderBy('id','desc')
        ->select('vehiclerent.*','users.name')
        ->leftJoin('users','users.id','=','vehiclerent.users_id')
        ->when($request->keyword, function ($query) use ($request) {
            $query->where('code','LIKE','%'.$request->keyword.'%')
                    ->orWhere('destination', 'LIKE','%'.$request->keyword.'%')
                    ->orWhere('date_from', 'LIKE','%'.$request->keyword.'%')
                    ->orWhere('users.name', 'LIKE','%'.$request->keyword.'%');
        })
        ->paginate('10');
        return view('invent/carrent.index',compact('data'));
    }

    function getKode(){
        $pinjem = Vehiclerent::orderBy('id','desc')->whereYear('created_at',date('Y'))->get();
        $first = "001";
        if($pinjem->count()>0){
          $first = $pinjem->first()->id+1;
          if($first < 10){
              $first = "00".$first;
          }else if($first < 100){
              $first = "0".$first;
          }
        }
        $kode = $first."/PKB/BBPOM/".date('m')."/".date('Y');
        return $kode;
      }

    public function create()
    {
        $kode = $this->getKode();
        return view('invent/carrent.create',compact('kode'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'date_from'     => 'required|date',
            'date_to'       => 'required|date',
            'car_id'        => 'required',
            'driver_id'     => 'required',
            'destination'   => 'required'
        ]);

        $pinjem = Vehiclerent::create($request->all());
        if($request->hasFile('file')){ // Kalau file ada
            $request->file('file')
                        ->move('images/pinjem/'.$pinjem->id,$request
                        ->file('file')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $pinjem->file = $request->file('file')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $pinjem->save(); // save ke database
        }




        return redirect('/invent/carrent/create')->with('sukses','Data Tersimpan');

    }

    public function edit($id)
    {
        $data = Vehiclerent::where('id',$id)->first();
        return view('invent/carrent.edit',compact('data'));
    }
    

    function getCar(Request $request){
        $car = Car::WhereRaw("id NOT IN (SELECT car_id from vehiclerent WHERE '".$request->tgl."' BETWEEN date_from AND date_to and status='Y') ")
                    ->get();
        $driver =User::where("deskjob","LIKE","%Sopir%")
                    ->WhereRaw("id NOT IN (SELECT driver_id from vehiclerent WHERE '".$request->tgl."' BETWEEN date_from AND date_to and status='Y') ")
                    ->get();
        
        return response()->json([ 
            'success'   => true,
            'car'       => $car,
            'driver'    =>$driver
            ],200
        );
    }

    public function update(Request $request, $id)
    {
        $data = Vehiclerent::find($id);
        $data->update($request->all());
        return redirect('/invent/carrent')->with('sukses','Data Diperbaharui');
    }


}
