<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Detailcode;
use App\Krocode;

class DetailcodeController extends Controller
{
    public function index(Request $request)
    {
        $data = Detailcode::orderBy('id','desc')
                            ->select('detailcode.*','krocode.code as kro')
                            ->leftJoin('krocode','krocode.id','=','detailcode.krocode_id')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('detailcode.code','LIKE','%'.$request->keyword.'%')
                                        ->orWhere('detailcode.name', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('krocode.code', 'LIKE','%'.$request->keyword.'%');
                            })
                            ->paginate('10');
        return view('finance/detailcode.index',compact('data'));
    }

    public function create()
    {
        $kro = Krocode::all();
        return view('finance/detailcode.create',compact('kro'));
    }

    public function store(Request $request)
    {
        
        Detailcode::create($request->all());
        return redirect('/finance/detailcode')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $kro = Krocode::all();
        $data = Detailcode::where('id',$id)->first();
        return view('finance/detailcode.edit',compact('data','kro'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Detailcode::find($id);
        $data->update($request->all());
        return redirect('/finance/detailcode')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Detailcode::find($id);
        $petugas->delete();
        return redirect('/finance/detailcode')->with('sukses','Data Terhapus');
    }

    public function getRO(Request $request)
    {
        $ro = Detailcode::orderBy('id','asc')->where('krocode_id',$request->kro_id)->get();
        return response()->json([ 
            'success' => true,
            'krocode_id'=>$request->kro_id,
            'data' => $ro],200
        );
    }
}
