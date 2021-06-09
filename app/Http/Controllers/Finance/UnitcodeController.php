<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Klcode;
use App\Unitcode;

class UnitcodeController extends Controller
{
    public function index(Request $request)
    {
        $data = Unitcode::orderBy('id','desc')
                ->paginate('10');
        return view('finance/unitcode.index',compact('data'));
    }

    public function create()
    {
        $kode = Klcode::all();
        return view('finance/unitcode.create',compact('kode'));
    }

    public function store(Request $request)
    {
        
        Unitcode::create($request->all());
        return redirect('/finance/unitcode')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $kode = Klcode::all();
        $data = Unitcode::where('id',$id)->first();
        return view('finance/unitcode.edit',compact('data','kode'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Unitcode::find($id);
        $data->update($request->all());
        return redirect('/finance/unitcode')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Unitcode::find($id);
        $petugas->delete();
        return redirect('/finance/unitcode')->with('sukses','Data Terhapus');
    }
}
