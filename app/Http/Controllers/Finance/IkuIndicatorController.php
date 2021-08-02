<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Target;
use App\Indicator;
use App\Komponencode;

class IkuIndicatorController extends Controller
{
    public function index(Request $request)
    {
        $data = Indicator::orderBy('id','desc')
                            ->select('indicator.*')
                            ->leftJoin('target','target.id','=','indicator.target_id')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('indicator.indicator','LIKE','%'.$request->keyword.'%')
                                        ->orWhere('target.name', 'LIKE','%'.$request->keyword.'%');
                            })
                            ->paginate('10');
        return view('finance/ikuIndicator.index',compact('data'));
    }

    public function create()
    {
        $target = Target::all();
        $komponen = Komponencode::all();
        return view('finance/ikuIndicator.create',compact('target','komponen'));
    }

    public function store(Request $request)
    {
        
        Indicator::create($request->all());
        return redirect('/finance/ikuIndicator')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $target = Target::all();
        $komponen = Komponencode::all();
        $data = Indicator::where('id',$id)->first();
        return view('finance/ikuIndicator.edit',compact('data','target','komponen'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Indicator::find($id);
        $data->update($request->all());
        return redirect('/finance/ikuIndicator')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Indicator::find($id);
        $petugas->delete();
        return redirect('/finance/ikuIndicator')->with('sukses','Data Terhapus');
    }
}
