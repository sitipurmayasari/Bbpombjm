<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Programcode;
use App\Unitcode;

class ProgramcodeController extends Controller
{
    public function index(Request $request)
    {
        $data = Programcode::orderBy('id','desc')
                            ->select('programcode.*','unitcode.code as unit','klcode.code as kl')
                            ->leftJoin('unitcode','unitcode.id','=','programcode.unitcode_id')
                            ->leftJoin('klcode','klcode.id','=','unitcode.klcode_id')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('klcode.code','LIKE','%'.$request->keyword.'%')
                                        ->orWhere('unitcode.code', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('programcode.code', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('programcode.name', 'LIKE','%'.$request->keyword.'%');
                                })
                            ->paginate('10');
        return view('finance/programcode.index',compact('data'));
    }

    public function create()
    {
        $unit = Unitcode::all();
        return view('finance/programcode.create',compact('unit'));
    }

    public function store(Request $request)
    {
        
        Programcode::create($request->all());
        return redirect('/finance/programcode')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $unit = Unitcode::all();
        $data = Programcode::where('id',$id)->first();
        return view('finance/programcode.edit',compact('data','unit'));
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
