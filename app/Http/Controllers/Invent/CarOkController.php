<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Car;
use App\Driver;
use App\Vehiclerent;
use App\Agenda;
use DateTime;

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

        $tgl1 = new DateTime($data->date_from);
        $tgl2 = new DateTime($data->date_to);
        $daylong = $tgl2->diff($tgl1)->days + 1;

        $date = date('Y-m-d', strtotime("+1 day", strtotime($data->date_from)));
        $date4 = date('Y-m-d', strtotime("+2 day", strtotime($data->date_from)));

        if ($daylong == 1) {
            $driver =Driver::where("aktif","Y")
                        ->WhereRaw("id NOT IN (SELECT driver_id from vehiclerent WHERE '".$data->date_from."' 
                                    BETWEEN date_from AND date_to and driver_id is not null AND status = 'Y') ")
                        ->get();

        } elseif ($daylong == 2) {
            $driver =Driver::where("aktif","Y")
                        ->WhereRaw("id NOT IN (SELECT driver_id from vehiclerent WHERE '".$data->date_from."' 
                                    BETWEEN date_from AND date_to and driver_id is not null AND status = 'Y') ")
                        ->WhereRaw("id NOT IN (SELECT driver_id from vehiclerent WHERE '".$data->date_to."' 
                                    BETWEEN date_from AND date_to and driver_id is not null AND status = 'Y') ")
                        ->get();

        } else{
            $driver =Driver::where("aktif","Y")
                            ->WhereRaw("id NOT IN (SELECT driver_id from vehiclerent WHERE '".$data->date_from."' 
                                        BETWEEN date_from AND date_to and driver_id is not null AND status = 'Y') ")
                            ->WhereRaw("id NOT IN (SELECT driver_id from vehiclerent WHERE '".$date."' 
                                        BETWEEN date_from AND date_to and driver_id is not null AND status = 'Y') ")
                            ->WhereRaw("id NOT IN (SELECT driver_id from vehiclerent WHERE '".$data->date_to."' 
                                        BETWEEN date_from AND date_to and driver_id is not null AND status = 'Y') ")
                            ->get();            
        }
        return view('invent/carok.yes',compact('data','car','driver','daylong'));
    }

    public function edit($id)
    {
        $data = Vehiclerent::where('id',$id)->first();
        $car = Car::where("type",$data->type)->get();
        $driver =Driver::where("aktif","Y")->get();
        
        return view('invent/carok.edit',compact('data','car','driver'));
    }
     
    public function update(Request $request, $id)
    {
        $data = Vehiclerent::find($id);
        $data->update($request->all());

        if ($request->status == "Y") {
            $car = Car::LeftJoin('vehiclerent','vehiclerent.car_id','=','car.id')
                    ->where('car.id',$data->car_id)->first();
            $driver = Driver::LeftJoin('vehiclerent','vehiclerent.driver_id','=','driver.id')
                    ->where('driver.id',$data->driver_id)->first();
                 
            if ($data->driver_id != null) {
                $jdl = $car->merk."(".$car->police_number.") Telah Dipinjam Dengan Supir ".$driver->name;
            } else {
                $jdl = $car->merk."(".$car->police_number.") Telah Dipinjam ";
            }

            $kale = [
                'vehiclerent_id' => $id,
                'agenda_kategori_id' => 5,
                'titles' => $jdl,
                'detail' => $jdl,
                'date_from' => $request->date_from,
                'date_to' => $request->date_to
            ];
            Agenda::create($kale);
        }
        return redirect('/invent/carok')->with('sukses','Data Diperbaharui');
    }

    public function revisi(Request $request, $id)
    {
        $data = Vehiclerent::find($id);
        $car = Car::where('id',$data->car_id)->first();
        $kal = Agenda::where('vehiclerent_id',$id)->first();
        $kal->delete();
        
        $data->update($request->all());

        if ($request->status == "Y") {
            $car = Car::LeftJoin('vehiclerent','vehiclerent.car_id','=','car.id')
                    ->where('car.id',$data->car_id)->first();
            $driver = Driver::LeftJoin('vehiclerent','vehiclerent.driver_id','=','driver.id')
                    ->where('driver.id',$data->driver_id)->first();
                 
            if ($data->driver_id != null) {
                $jdl = $car->merk."(".$car->police_number.") Telah Dipinjam Dengan Supir ".$driver->name;
            } else {
                $jdl = $car->merk."(".$car->police_number.") Telah Dipinjam ";
            }

            $kale = [
                'vehiclerent_id' => $id,
                'agenda_kategori_id' => 5,
                'titles' => $jdl,
                'detail' => $jdl,
                'date_from' => $request->date_from,
                'date_to' => $request->date_to
            ];
            Agenda::create($kale);
        }
        return redirect('/invent/carok')->with('sukses','Data Diperbaharui');
    }


}
