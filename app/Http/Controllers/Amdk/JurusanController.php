<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pendidikan;
use App\Jurusan;
use LogActivity;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        $jenjang = Pendidikan::all();
        $data = Jurusan::orderBy('id','desc')
                ->paginate('10');
        return view('amdk/jurusan.index',compact('data','jenjang'));
    }

    public function store(Request $request)
    {
        
        $data= Jurusan::create($request->all());
        LogActivity::addToLog('Simpan->Jurusan, id = '.$data->id);

        return redirect('/amdk/jurusan')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $jenjang = Pendidikan::all();
        $data = Jurusan::where('id',$id)->first();
        return view('amdk/jurusan.edit',compact('data','jenjang'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Jurusan::find($id);
        $data->update($request->all());
        LogActivity::addToLog('Update->Jurusan, id = '.$id);

        return redirect('/amdk/jurusan')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Jurusan::find($id);
        LogActivity::addToLog('Hapus->Jurusan, '.$data->jurusan);
        $data->delete();
        return redirect('/amdk/jurusan')->with('sukses','Data Terhapus');
    }


    public function getpend(Request $request)
    {
        $pendidikan = Jurusan::orderBy('id','asc')->where('pendidikan_id',$request->pendidikan_id)->get();
        return response()->json([ 'success' => true,'pend'=>$request->pendidikan_id,'data' => $pendidikan],200);
    }

}
