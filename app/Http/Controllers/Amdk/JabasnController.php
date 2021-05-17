<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jabasn;

class JabasnController extends Controller
{
    public function index(Request $request)
    {
        $data = Jabasn::orderBy('id','desc')
                ->paginate('10');
        return view('amdk/jabasn.index',compact('data'));
    }

    public function store(Request $request)
    {
        Jabasn::create($request->all());
        return redirect('/amdk/jabasn')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Jabasn::where('id',$id)->first();
        return view('amdk/jabasn.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Jabasn::find($id);
        $data->update($request->all());
        return redirect('/amdk/jabasn')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $jabatan = Jabasn::find($id);
        $jabatan->delete();
        return redirect('/amdk/jabasn')->with('sukses','Data Terhapus');
    }
}
