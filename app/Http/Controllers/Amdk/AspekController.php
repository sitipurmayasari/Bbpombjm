<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Aspek_evaluasi;
use LogActivity;

class AspekController extends Controller
{
    public function index(Request $request)
    {
        $data = Aspek_evaluasi::orderBy('id','desc')
                ->paginate('10');
        return view('amdk/aspek.index',compact('data'));
    }

    public function store(Request $request)
    {
        
        $data= Aspek_evaluasi::create($request->all());
        LogActivity::addToLog('Simpan->Aspek_evaluasi, id = '.$data->id);

        return redirect('/amdk/aspek')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Aspek_evaluasi::where('id',$id)->first();
        return view('amdk/aspek.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Aspek_evaluasi::find($id);
        $data->update($request->all());
        LogActivity::addToLog('Update->Aspek_evaluasi, id = '.$id);

        return redirect('/amdk/aspek')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Aspek_evaluasi::find($id);
        LogActivity::addToLog('Hapus->Aspek_evaluasi, '.$data->aspek);
        $data->delete();
        return redirect('/amdk/aspek')->with('sukses','Data Terhapus');
    }

}
