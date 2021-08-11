<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Destination;
use App\Jabatan;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $data = Destination::orderBy('id','desc')
                        ->where('type','=','D')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('province','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('district', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('capital', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        $dataln = Destination::orderBy('id','desc')
                        ->where('type','=','L')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('country','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('capital', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('finance/destination.index',compact('data','dataln'));
    }

    public function create()
    {
        $jab= Jabatan::WhereRaw('urutan IN (1,2,3,4,5)')->orderBy('urutan','asc')->get();
        return view('finance/destination.create',compact('jab'));
    }

    public function store(Request $request)
    {
        Destination::create($request->all());
        return redirect('/finance/destination')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $jab= Jabatan::WhereRaw('urutan IN (1,2,3,4,5)')->orderBy('urutan','asc')->get();
        $data = Destination::where('id',$id)->first();
        return view('finance/destination.edit',compact('data','jab'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Destination::find($id);
        $data->update($request->all());
        return redirect('/finance/destination')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Destination::find($id);
        $petugas->delete();
        return redirect('/finance/destination')->with('sukses','Data Terhapus');
    }
}
