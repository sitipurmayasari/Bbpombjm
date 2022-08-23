<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;

use App\Libur;

class LiburController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();
        $data = Libur::orderBy('id','desc')
                ->paginate('10');
        return view('amdk/libur.index',compact('data','now'));
    }

    public function store(Request $request)
    {
        
        Libur::create($request->all());
        return redirect('/amdk/libur')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Libur::where('id',$id)->first();
        return view('amdk/libur.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Libur::find($id);
        $data->update($request->all());
        return redirect('/amdk/libur')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Libur::find($id);
        $data->delete();
        return redirect('/amdk/libur')->with('sukses','Data Terhapus');
    }
}
