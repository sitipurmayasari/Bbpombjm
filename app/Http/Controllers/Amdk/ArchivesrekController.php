<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Archives;
use App\Mailclasification;
use App\Divisi;
use App\Mailsubgroup;
use App\Mailgroup;

class ArchivesrekController extends Controller
{

    public function index(Request $request)
    {
        $klas = Mailgroup::all();
        $data = Archives::orderBy('archives.id','desc')
                ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                ->whereRaw('CURDATE() BETWEEN DATE(archives.date) 
                and DATE_ADD(DATE(archives.date),INTERVAL mailclasification.actived YEAR)')
                ->when($request->keyword, function ($query) use ($request) {
                $query->where('uraian','LIKE','%'.$request->keyword.'%')
                        ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                        ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                })
                ->paginate('10');
                $datainac = Archives::orderBy('archives.id','desc')
                    ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                    ->whereRaw('curdate() > DATE_ADD(archives.date,INTERVAL mailclasification.actived YEAR)')
                    ->when($request->keyword, function ($query) use ($request) {
                    $query->where('uraian','LIKE','%'.$request->keyword.'%')
                    ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                    ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        $datadel = Archives::onlyTrashed()->paginate('10');
        return view('amdk/archivesrek.index',compact('data','datainac','datadel','klas'));
    }

    public function create()
    {
        $div = Divisi::where('id','!=','1')->get();
        $masa = Mailclasification::all();
        return view('amdk/archivesrek.create',compact('masa','div'));
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


        return redirect('/amdk/archivesrek')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $masa = Mailclasification::all();
        $data = Archives::where('id',$id)->first();
        return view('amdk/archivesrek.edit',compact('data','masa'));
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

        return redirect('/amdk/archivesrek')->with('sukses','Data Diperbaharui');

    }
    
    public function delete($id)
    {
        $data = Archives::find($id);
        $data->delete();
        return redirect('/amdk/archivesrek')->with('sukses','Data Terhapus');
    }

      
    public function deleteper($id)
    {
        $data = Archives::find($id);
        $data->forceDelete();
        return redirect('/amdk/archivesrek')->with('sukses','Data Terhapus');
    }

}