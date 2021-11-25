<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agenda_kategori;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $data = Agenda_kategori::orderBy('id','desc')
                ->paginate('10');
        return view('amdk/kategori.index',compact('data'));
    }

    public function store(Request $request)
    {
        
        Agenda_kategori::create($request->all());
        return redirect('/amdk/kategori')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Agenda_kategori::where('id',$id)->first();
        return view('amdk/kategori.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Agenda_kategori::find($id);
        $data->update($request->all());
        return redirect('/amdk/kategori')->with('sukses','Data Diperbaharui');
    }


}
