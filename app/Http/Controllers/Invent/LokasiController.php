<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Lokasi;

class LokasiController extends Controller
{
    public function index(Request $request)
    {
        $data = Lokasi::orderBy('id','desc')
                ->paginate('10');
        return view('invent/lokasi.index',compact('data'));
    }

    public function store(Request $request)
    {
        Lokasi::create($request->all());
        return redirect('/invent/lokasi')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Lokasi::where('id',$id)->first();
        return view('invent/lokasi.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request,['nama' => 'required']);
        $data = Lokasi::find($id);
        $data->update($request->all());
        return redirect('/invent/lokasi')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $lokasi = Lokasi::find($id);
        $lokasi->delete();
        return redirect('/invent/lokasi')->with('sukses','Data Terhapus');
    }
}
