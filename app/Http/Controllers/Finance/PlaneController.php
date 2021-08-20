<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plane;

class PlaneController extends Controller
{
    public function index(Request $request)
    {
        $data = Plane::orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('code','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('finance/plane.index',compact('data'));
    }

    public function create()
    {
        return view('finance/plane.create');
    }

    public function store(Request $request)
    {
        
        Plane::create($request->all());
        return redirect('/finance/plane')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Plane::where('id',$id)->first();
        return view('finance/plane.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Plane::find($id);
        $data->update($request->all());
        return redirect('/finance/plane')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Plane::find($id);
        $petugas->delete();
        return redirect('/finance/plane')->with('sukses','Data Terhapus');
    }
}
