<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

use App\Car;
use App\JadwalCar;
use App\User;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $data = Car::orderBy('id','desc')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('code','LIKE','%'.$request->keyword.'%')
                                ->orWhere('merk', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('police_number', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('invent/vehicle.index',compact('data'));
    }

    public function create()
    {
        $pj = User::where('aktif','Y')->where('id','!=','1')->get();
        return view('invent/vehicle.create',compact('pj'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'code'          => 'required|unique:car',
            'merk'          => 'required',
            'police_number' => 'required'
        ]);

        Car::create($request->all());

        return redirect('/invent/vehicle')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Car::where('id',$id)->first();
        $pj = User::where('aktif','Y')->where('id','!=','1')->get();
        return view('invent/vehicle.edit',compact('data','pj'));
    }

   
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,[
                'police_number' => 'required',
                'operasional' => 'required'
            ]);
        $data = Car::find($id);
        $data->update($request->all());
        return redirect('/invent/vehicle')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Car::find($id);
        $data->delete();
        return redirect('/invent/vehicle')->with('sukses','Data Terhapus');
    }

    public function jadwal($id)
    {
        $jadwal = JadwalCar::orderBy('id','asc')
                    ->where('car_id',$id)
                    ->get();
        $data = Car::where('id',$id)->first();

        return view('invent/vehicle.jadwal',compact('data','jadwal'));
    }

    public function storejadwal(Request $request)
    {
        $jadwal = JadwalCar::create($request->all());
        return redirect('/invent/vehicle/jadwal/'.$jadwal->car_id)->with('sukses','Data Tersimpan');
    }

    public function deletejadwal($id)
    {
        $data = JadwalCar::find($id);
        $data->delete();
        return redirect('/invent/vehicle/jadwal/'.$data->car_id)->with('sukses','Data Terhapus');
    }

    public function editjadwal($id)
    {
        $data = JadwalCar::where('id',$id)->first();
        $jadwal = JadwalCar::orderBy('id','asc')
                        ->where('car_id',$data->car_id)
                        ->get();
        return view('invent/vehicle.editjadwal',compact('data','jadwal'));
    }

    public function updatejadwal(Request $request, $id)
    {
        $data = JadwalCar::find($id);
        $data->update($request->all());

        return redirect('/invent/vehicle/jadwal/'.$data->car_id)->with('sukses','Data Terhapus');
    }


    public function matriks()
    {   
        $now = Carbon::now()->year;
        $data = Car::whereYear('tax_date',$now)->get();

        // $pdf = PDF::loadview('invent/vehicle.matriks',compact('data','now'));
        // return $pdf->stream();
        return view('invent/vehicle.matriks',compact('data','now'));
    }
}
