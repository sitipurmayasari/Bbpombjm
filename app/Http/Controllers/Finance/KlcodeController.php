<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Klcode;

class KlcodeController extends Controller
{
    public function index(Request $request)
    {
        $data = Klcode::orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('code','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('finance/klcode.index',compact('data'));
    }

    public function create()
    {
        return view('finance/klcode.create');
    }

    public function store(Request $request)
    {
        
        Klcode::create($request->all());
        return redirect('/finance/klcode')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Klcode::where('id',$id)->first();
        return view('finance/klcode.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Klcode::find($id);
        $data->update($request->all());
        return redirect('/finance/klcode')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Klcode::find($id);
        $petugas->delete();
        return redirect('/finance/klcode')->with('sukses','Data Terhapus');
    }
}
