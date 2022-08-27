<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Absensi;

class PermitController extends Controller
{
    public function index(Request $request)
    {
        $peg = auth()->user()->id;
        $data = Absensi::orderBy('id','desc')
                ->where('users_id',$peg )
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('tanggal','LIKE','%'.$request->keyword.'%')
                            ->orWhere('keterangan', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('30');
        return view('amdk/permit.index',compact('data'));
    }

    public function create()
    {
        // $kategori = Agenda_kategori::All();
        return view('amdk/permit.create');
    }
 
    // public function store(Request $request)
    // {
    //     $this->validate($request,[
    //         'agenda_kategori_id' => 'required',
    //         'titles' => 'required',
    //         'detail' => 'required',
    //         'date_from' => 'required',
    //         'date_to' => 'required'
    //     ]);
    //     Agenda::create($request->all());
    //     return redirect('/amdk/permit')->with('sukses','Data Tersimpan');
    // }
   
    // public function edit($id)
    // {
    //     $kategori = Agenda_kategori::All();
    //     $data = Agenda::where('id',$id)->first();
    //     return view('amdk/permit.edit',compact('data','kategori'));
    // }

   
    // public function update(Request $request, $id)
    // {
    //     $data = Agenda::find($id);
    //     $data->update($request->all());
    //     return redirect('/amdk/permit')->with('sukses','Data Diperbaharui');
    // }

    // public function delete($id)
    // {
    //     $data = Agenda::find($id);
    //     $data->delete();
    //     return redirect('/amdk/permit')->with('sukses','Data Terhapus');

    // }
}
