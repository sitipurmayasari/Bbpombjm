<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Programcode;

class ProgramcodeController extends Controller
{
    public function index(Request $request)
    {
        $data = Programcode::orderBy('id','desc')
                ->paginate('10');
        return view('finance/programcode.index',compact('data'));
    }

    public function create()
    {
        return view('finance/programcode.create');
    }

    public function store(Request $request)
    {
        
        Programcode::create($request->all());
        return redirect('/finance/programcode')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Programcode::where('id',$id)->first();
        return view('finance/programcode.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Programcode::find($id);
        $data->update($request->all());
        return redirect('/finance/programcode')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Programcode::find($id);
        $petugas->delete();
        return redirect('/finance/programcode')->with('sukses','Data Terhapus');
    }
}
