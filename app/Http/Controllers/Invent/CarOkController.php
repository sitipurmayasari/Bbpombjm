<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Car;
use App\User;
use App\Outstation;
use App\Pejabat;
use App\Vehiclerent;
use App\Agenda;
use PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CarOkController extends Controller
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
        return view('invent/carok.index',compact('data'));
    }

    public function yes($id)
    {
        $data = Vehiclerent::where('id',$id)->first();

        $car = Car::WhereRaw("id NOT IN (SELECT car_id from vehiclerent WHERE '".$data->date_from."' BETWEEN date_from AND date_to and status='Y') ")
                    ->where("type",$data->type)            
                    ->get();
        $driver =User::where("deskjob","LIKE","%Sopir%")
                    ->WhereRaw("id NOT IN (SELECT driver_id from vehiclerent WHERE '".$data->date_from."' BETWEEN date_from AND date_to and status='Y') ")
                    ->get();



        return view('invent/carok.yes',compact('data','car','driver'));
    }

    public function edit($id)
    {
        $data = Vehiclerent::where('id',$id)->first();
        $car = Car::where("type",$data->type)->get();
        $driver =User::where("deskjob","LIKE","%Sopir%")->get();
        
        return view('invent/carok.edit',compact('data','car','driver'));
    }
     
    public function update(Request $request, $id)
    {
        $data = Vehiclerent::find($id);
        $data->update($request->all());

        $car = Car::LeftJoin('vehiclerent','vehiclerent.car_id','=','car.id')
                    ->where('car.id',$data->car_id)->first();
        $jdl = $car->merk."(".$car->police_number.") Telah Dipinjam";

        $kale = [
            'agenda_kategori_id' => 5,
            'titles' => $jdl,
            'detail' => $jdl,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to
        ];
        Agenda::create($kale);

        return redirect('/invent/carok')->with('sukses','Data Diperbaharui');
    }


}
