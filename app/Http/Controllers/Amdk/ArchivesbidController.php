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
        $data = Archives::selectraw('archives.*, mailclasification.alias,mailclasification.names,mailclasification.actived,
               mailclasification.innactive,mailclasification.thelast,
                CURDATE() AS hari_ini,
                DATE_ADD(DATE(archives.date),INTERVAL mailclasification.actived YEAR) batas_aktif')
                ->orderBy('archives.id','desc')
                ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                ->where('divisi_id','=',$div_id)
                ->whereRaw('CURDATE() BETWEEN DATE(archives.date) 
                and DATE_ADD(DATE(archives.date),INTERVAL mailclasification.actived YEAR)')
                ->when($request->keyword, function ($query) use ($request) {
                $query->where('uraian','LIKE','%'.$request->keyword.'%')
                        ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                        ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                })
                ->paginate('10');
        $datainac = Archives::selectraw('archives.*, mailclasification.alias,mailclasification.names,mailclasification.actived,
                   mailclasification.innactive,mailclasification.thelast,
                    CURDATE() AS hari_ini,
                    DATE_ADD(DATE(archives.date),INTERVAL mailclasification.actived YEAR) batas_aktif')
                    ->orderBy('archives.id','desc')
                    ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                    ->where('divisi_id','=',$div_id)
                    ->whereRaw('curdate() > DATE_ADD(archives.date,INTERVAL mailclasification.actived YEAR)')
                    ->when($request->keyword, function ($query) use ($request) {
                    $query->where('uraian','LIKE','%'.$request->keyword.'%')
                    ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                    ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        $datadel = Archives::onlyTrashed()->paginate('10');
        $div = Divisi::where('id',$div_id)->first();
        return view('amdk/archivesbid.index',compact('data','div','datainac','datadel'));
    }

    public function edit($id)
    {
        $div_id =auth()->user()->divisi_id;
        $div = Divisi::where('id',$div_id)->first();
        $masa = Mailclasification::all();
        $data = Archives::where('id',$id)->first();
        return view('amdk/archivesbid.edit',compact('data','masa','div'));
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
        $data->forceDelete();
        return redirect('/amdk/archivesbid')->with('sukses','Data Terhapus');
    }

}
