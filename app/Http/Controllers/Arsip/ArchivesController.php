<?php

namespace App\Http\Controllers\Arsip;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Archives;
use App\Mailclasification;

class ArchivesController extends Controller
{

    public function index(Request $request)
    {
        $peg =auth()->user()->id;
        $data = Archives::selectraw('archives.*, mailclasification.alias,mailclasification.names,
                                    CURDATE() AS hari_ini,
                                    DATE_ADD(DATE(archives.date),INTERVAL mailclasification.actived YEAR) batas_aktif')
                        ->orderBy('archives.id','desc')
                        ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                        ->where('users_id','=',$peg)
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('uraian','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                            })
                        ->paginate('10');
        return view('arsip/archives.index',compact('data'));
    }

    public function create()
    {
        $masa = Mailclasification::all();
        return view('arsip/archives.create',compact('masa'));
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


        return redirect('/arsip/archives')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $masa = Mailclasification::all();
        $data = Archives::where('id',$id)->first();
        return view('arsip/archives.edit',compact('data','masa'));
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

        return redirect('/arsip/archives')->with('sukses','Data Diperbaharui');

    }

    
    public function delete($id)
    {
        $data = Archives::find($id);
        $data->forceDelete();
        return redirect('/arsip/archives')->with('sukses','Data Terhapus');
    }




}
