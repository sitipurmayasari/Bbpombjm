<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Car;

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

        return view('invent/vehicle.create');
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
        return view('invent/vehicle.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request,['police_number' => 'required']);
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
}
