<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subcode;
use App\Komponencode;

class SubcodeController extends Controller
{
    public function index(Request $request)
    {
        $data = Subcode::orderBy('name','asc')
                        ->select('subcode.*')
                        ->leftJoin('komponencode','komponencode.id','=','subcode.komponencode_id')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('komponencode.code','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('subcode.code', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('subcode.kodeall', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('subcode.name', 'LIKE','%'.$request->keyword.'%');
                            })
        ->paginate('10');
        return view('finance/subcode.index',compact('data'));
    }

    public function create()
    {
        $kode = Komponencode::all();
        return view('finance/subcode.create',compact('kode'));
    }

    public function store(Request $request)
    {   
        $kodeall = $request->lengkap."/".$request->code;
        $request->merge([ 'kodeall' => $kodeall]);
        
        Subcode::create($request->all());
        return redirect('/finance/subcode')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $kode = Komponencode::all();
        $data = Subcode::where('id',$id)->first();
        return view('finance/subcode.edit',compact('data','kode'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Subcode::find($id);
        
        $kodeall = $request->lengkap."/".$request->code;
        $request->merge([ 'kodeall' => $kodeall]);
        
        $data->update($request->all());
        return redirect('/finance/subcode')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Subcode::find($id);
        $petugas->delete();
        return redirect('/finance/subcode')->with('sukses','Data Terhapus');
    }

    public function getSubkom(Request $request)
    {
        $sub = Subcode::orderBy('id','asc')->where('komponencode_id',$request->komponencode_id)->get();
        return response()->json([ 
            'success' => true,
            'komponencode_id'=>$request->komponencode_id,
            'data' => $sub],200
        );
    }

    public function getKomLengkap(Request $request)
    {

        $data = Komponencode::SelectRaw('krocode.code AS kro, detailcode.code AS det, komponencode.code AS kom')
                ->leftJoin('detailcode','komponencode.detailcode_id','=','detailcode.id')
                ->leftJoin('krocode','krocode.id','=','detailcode.krocode_id')
                ->Where('komponencode.id',$request->komponencode_id)->first();
        return response()->json([ 
            'success' => true,
            'data' => $data],200
        );
    }
}
