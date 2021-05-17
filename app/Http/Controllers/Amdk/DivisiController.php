<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Divisi;
use App\Subdivisi;


class DivisiController extends Controller
{
    public function index(Request $request)
    {
        $divisi = Divisi::all();
        $data = Subdivisi::orderBy('id','desc')
                ->select('subdivisi.*','divisi.nama')
                ->leftJoin('divisi','divisi.id','=','subdivisi.divisi_id')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('nama_subdiv','LIKE','%'.$request->keyword.'%')
                            ->orWhere('nama', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('amdk/divisi.index',compact('data','divisi'));
    }

    public function create()
    {
        $divisi = Divisi::all();

        return view('amdk/divisi.create',compact('divisi'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama_subdiv' => 'required|unique:subdivisi'
        ]);
        Subdivisi::create($request->all());
        return redirect('/amdk/divisi')->with('sukses','Data Tersimpan');
    }
   
   
    public function edit($id)
    {
        $divisi = Divisi::all();
        $data = Subdivisi::where('id',$id)->first();
        return view('amdk/divisi.edit',compact('data','divisi'));
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request,['nama_subdiv' => 'required']);
        $subdivisi = Subdivisi::find($id);
        $subdivisi->update($request->all());
        return redirect('/amdk/divisi')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $subdivisi = Subdivisi::find($id);
        $subdivisi->delete();
        return redirect('/amdk/divisi')->with('sukses','Data Terhapus');

    }

    public function getSubDivisi(Request $request)
    {
        $subDivisi = Subdivisi::orderBy('id','asc')->where('divisi_id',$request->divisi_id)->get();
        return response()->json([ 'success' => true,'divisi'=>$request->divisi_id,'data' => $subDivisi],200);
    }
}
