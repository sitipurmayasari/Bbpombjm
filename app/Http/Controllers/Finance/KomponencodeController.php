<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Komponencode;
use App\Detailcode;

class KomponencodeController extends Controller
{
    public function index(Request $request)
    {
        $data = Komponencode::orderBy('id','desc')
                        ->select('komponencode.*','detailcode.code as det')
                        ->leftJoin('detailcode','detailcode.id','=','komponencode.detailcode_id')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('komponencode.code','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('komponencode.name', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('detailcode.code', 'LIKE','%'.$request->keyword.'%');
                                        })
                        ->paginate('10');
        return view('finance/komponencode.index',compact('data'));
    }

    public function create()
    {
        $detail = Detailcode::all();
        return view('finance/komponencode.create',compact('detail'));
    }

    public function store(Request $request)
    {
       
        Komponencode::create($request->all());
        return redirect('/finance/komponencode')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $detail = Detailcode::all();
        $data = Komponencode::where('id',$id)->first();
        return view('finance/komponencode.edit',compact('data','detail'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Komponencode::find($id);
        $data->update($request->all());
        return redirect('/finance/komponencode')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Komponencode::find($id);
        $petugas->delete();
        return redirect('/finance/komponencode')->with('sukses','Data Terhapus');
    }
}
