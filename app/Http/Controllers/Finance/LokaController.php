<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Loka;

class LokaController extends Controller
{
    public function index(Request $request)
    {
        $data = Loka::orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('code','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('finance/loka.index',compact('data'));
    }

    public function store(Request $request)
    {
        
        Loka::create($request->all());
        return redirect('/finance/loka')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Loka::where('id',$id)->first();
        return view('finance/loka.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Loka::find($id);
        $data->update($request->all());
        return redirect('/finance/loka')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Loka::find($id);
        $petugas->delete();
        return redirect('/finance/loka')->with('sukses','Data Terhapus');
    }
}
