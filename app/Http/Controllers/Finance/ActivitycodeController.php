<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Activitycode;
use App\Programcode;

class ActivitycodeController extends Controller
{
    public function index(Request $request)
    {
        $data = Activitycode::orderBy('id','desc')
                            ->select('activitycode.*')
                            ->leftJoin('programcode','programcode.id','=','activitycode.programcode_id')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('activitycode.code','LIKE','%'.$request->keyword.'%')
                                        ->orWhere('activitycode.name', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('programcode.code', 'LIKE','%'.$request->keyword.'%');
                            })
                            ->paginate('10');
        return view('finance/activitycode.index',compact('data'));
    }

    public function create()
    {
        $program = Programcode::all();
        return view('finance/activitycode.create',compact('program'));
    }

    public function store(Request $request)
    {
        $lengkap = $request->lengkap."/".$request->code;
        $request->merge([ 'lengkap' => $lengkap]);

        Activitycode::create($request->all());
        return redirect('/finance/activitycode')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $program = Programcode::all();
        $data = Activitycode::where('id',$id)->first();
        return view('finance/activitycode.edit',compact('data','program'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Activitycode::find($id);

        $lengkap = $request->lengkap."/".$request->code;
        $request->merge([ 'lengkap' => $lengkap]);

        $data->update($request->all());
        return redirect('/finance/activitycode')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Activitycode::find($id);
        $petugas->delete();
        return redirect('/finance/activitycode')->with('sukses','Data Terhapus');
    }

    public function getprogLengkap(Request $request)
    {

        $data = Programcode::SelectRaw('programcode.code AS prog, unitcode.code AS unit, klcode.code AS kl')
                ->leftJoin('unitcode','unitcode.id','=','programcode.unitcode_id')
                ->leftJoin('klcode','klcode.id','=','unitcode.klcode_id')
                ->Where('programcode.id',$request->programcode_id)->first();
        return response()->json([ 
            'success' => true,
            'data' => $data],200
        );
    }
}
