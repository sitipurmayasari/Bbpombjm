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
                    ->get();
        $driver =User::where("deskjob","LIKE","%Sopir%")
                    ->WhereRaw("id NOT IN (SELECT driver_id from vehiclerent WHERE '".$data->date_from."' BETWEEN date_from AND date_to and status='Y') ")
                    ->get();



        return view('invent/carok.yes',compact('data','car','driver'));
    }

    public function edit($id)
    {

        $car = Car::all();
        $driver =User::where("deskjob","LIKE","%Sopir%")->get();

        $data = Vehiclerent::where('id',$id)->first();
        return view('invent/carok.edit',compact('data','car','driver'));
    }
    
    public function update(Request $request, $id)
    {
        $data = Vehiclerent::find($id);
        $data->update($request->all());
        return redirect('/invent/carok')->with('sukses','Data Diperbaharui');
    }


}
