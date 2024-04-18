<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Indicator;
use App\Linkaluh;

class AluhController extends Controller
{
    public function index(Request $request)
    {
        $data = Linkaluh::orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('name','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('aktif', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('finance/aluh.index',compact('data'));
    }

    public function create()
    {
        $iku = Indicator::all();
        return view('finance/aluh.create',compact('iku'));
    }

    public function store(Request $request)
    {
        
        Linkaluh::create($request->all());
        return redirect('/finance/aluh')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $iku = Indicator::all();
        $data = Linkaluh::where('id',$id)->first();
        return view('finance/aluh.edit',compact('data','iku'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Linkaluh::find($id);
        $data->update($request->all());
        return redirect('/finance/aluh')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Linkaluh::find($id);
        $data->delete();
        return redirect('/finance/aluh')->with('sukses','Data Terhapus');
    }
}
