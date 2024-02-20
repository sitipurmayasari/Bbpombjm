<?php

namespace App\Http\Controllers\Calibration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Parameter;

class ParameterController extends Controller
{
    public function index(Request $request)
    {
        $data = Parameter::orderBy('id','desc')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('komuditi','LIKE','%'.$request->keyword.'%')
                            ->orWhere('nama', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('calibration/parameter.index',compact('data'));
    }

    public function create()
    {
        return view('calibration/parameter.create');
    }

    public function store(Request $request)
    {
        Parameter::create($request->all());
        return redirect('/calibration/parameter')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Parameter::find($id);
        return view('calibration/parameter.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Parameter::find($id);
        $data->update($request->all());
        return redirect('/calibration/parameter')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Parameter::find($id);
        $data->delete();
       
        return redirect('/calibration/parameter')->with('sukses','Data Terhapus');
    }
}
