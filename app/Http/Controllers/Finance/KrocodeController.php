<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Krocode;

class KrocodeController extends Controller
{
    public function index(Request $request)
    {
        $data = Krocode::orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('code','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('finance/krocode.index',compact('data'));
    }

    public function create()
    {
        return view('finance/krocode.create');
    }

    public function store(Request $request)
    {
        
        Krocode::create($request->all());
        return redirect('/finance/krocode')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Krocode::where('id',$id)->first();
        return view('finance/krocode.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Krocode::find($id);
        $data->update($request->all());
        return redirect('/finance/krocode')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Krocode::find($id);
        $petugas->delete();
        return redirect('/finance/krocode')->with('sukses','Data Terhapus');
    }
}
