<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Perspective;
use App\Target;
class IkuTargetController extends Controller
{
    public function index(Request $request)
    {
        $data = Target::orderBy('id','desc')
                            ->select('target.*')
                            ->leftJoin('perspective','perspective.id','=','target.perspective_id')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('perspective.name','LIKE','%'.$request->keyword.'%')
                                        ->orWhere('target.name', 'LIKE','%'.$request->keyword.'%');
                            })
                            ->paginate('10');
        return view('finance/ikuTarget.index',compact('data'));
    }

    public function create()
    {
        $per = Perspective::all();
        return view('finance/ikuTarget.create',compact('per'));
    }

    public function store(Request $request)
    {
        
        Target::create($request->all());
        return redirect('/finance/ikuTarget')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $per = Perspective::all();
        $data = Target::where('id',$id)->first();
        return view('finance/ikuTarget.edit',compact('data','per'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Target::find($id);
        $data->update($request->all());
        return redirect('/finance/ikuTarget')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Target::find($id);
        $petugas->delete();
        return redirect('/finance/activitycode')->with('sukses','Data Terhapus');
    }
}
