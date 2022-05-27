<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Archives;
use App\Mailclasification;
use App\Divisi;

class ArchivesbidController extends Controller
{

    public function index(Request $request)
    {
        $div_id =auth()->user()->divisi_id;
        $data = Archives::orderBy('id','desc')
                        ->where('divisi_id','=',$div_id)
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('uraian','LIKE','%'.$request->keyword.'%');
                            })
                        ->paginate('10');
        $div = Divisi::where('id',$div_id)->first();
        return view('amdk/archivesbid.index',compact('data','div'));
    }

    public function store(Request $request)
    {
        $user_id = $request->users_id;

        $this->validate($request,[
            'uraian' => 'required'
        ]);

        $dokument = Archives::create($request->all());
        if($request->hasFile('file')){ // Kalau file ada
            $request->file('file')
                        ->move('images/arsiparis/'.$dokument->id,$request
                        ->file('file')
                        ->getClientOriginalName()); 
            $dokument->file = $request->file('file')->getClientOriginalName(); 
            $dokument->save();
          }


        return redirect('/amdk/archivesbid')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $masa = Mailclasification::all();
        $data = Archives::where('id',$id)->first();
        return view('amdk/archivesbid.edit',compact('data','masa'));
    }


    public function update(Request $request, $id)
    {
        $user_id = $request->users_id;
        $data = Archives::find($id);
        $data->update($request->all());
        if($request->hasFile('file')){ // Kalau file ada
            $request->file('file')
                        ->move('images/arsiparis/'.$data->id,$request
                        ->file('file')
                        ->getClientOriginalName()); 
            $data->file = $request->file('file')->getClientOriginalName(); 
            $data->save();
          }

        return redirect('/amdk/archivesbid')->with('sukses','Data Diperbaharui');

    }

    
    public function delete($id)
    {
        $data = Archives::find($id);
        $data->delete();
        return redirect('/amdk/archivesbid')->with('sukses','Data Terhapus');
    }




}
