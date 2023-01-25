<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Target;
use App\Indicator;
use App\Divisi;
use LogActivity;

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
        $div    = Divisi::where('id','!=','1')->get();
        $target = Target::all();
        return view('finance/ikuIndicator.create',compact('target','div'));
    }

    public function store(Request $request)
    {
        
        $data = Indicator::create($request->all());
        LogActivity::addToLog('Simpan->Indikator Kinerja Utama, id = '.$data->id);
        return redirect('/finance/ikuIndicator')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $div    = Divisi::where('id','!=','1')->get();
        $target = Target::all();
        $data = Indicator::where('id',$id)->first();
        return view('finance/ikuIndicator.edit',compact('data','target','div'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Indicator::find($id);
        $data->update($request->all());
        LogActivity::addToLog('Ubah->Indikator Kinerja Utama, id = '.$id);
        return redirect('/finance/ikuIndicator')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Indicator::find($id);
        $petugas->delete();
        return redirect('/finance/ikuIndicator')->with('sukses','Data Terhapus');
    }
}
