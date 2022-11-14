<?php

namespace App\Http\Controllers\Arsip;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Archives;
use App\Archives_att;
use App\Mailclasification;
use App\Divisi;
use App\Mailsubgroup;
use App\Mailgroup;
use App\Naskah;

class ArchivesrekController extends Controller
{

    public function index(Request $request)
    {
        $klas = Mailgroup::all();
        $data = Archives::orderBy('archives.id','desc')
                ->Selectraw('archives.*')
                ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                ->where('status','aktif')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('uraian','LIKE','%'.$request->keyword.'%')
                        ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                        ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                })
                ->paginate('10');
        $datainac = Archives::orderBy('archives.id','desc')
                    ->Selectraw('archives.*')
                    ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                    ->where('status','inaktif')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('uraian','LIKE','%'.$request->keyword.'%')
                            ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        $dataper = Archives::orderBy('archives.id','desc')
                    ->Selectraw('archives.*')
                    ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                    ->where('status','permanen')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('uraian','LIKE','%'.$request->keyword.'%')
                            ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');

        $datakan = Archives::orderBy('archives.id','desc')
                    ->Selectraw('archives.*')
                    ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                    ->where('status','akanmusnah')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('uraian','LIKE','%'.$request->keyword.'%')
                            ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        $datadel = Archives::onlyTrashed()->paginate('10');
        
        return view('arsip/archivesrek.index',compact('data','datainac','datadel','klas','dataper','datakan'));
    }

    public function create()
    {
        $div = Divisi::where('id','!=','1')->get();
        $masa = Mailclasification::all();
        $naskah = Naskah::all();
        return view('arsip/archivesrek.create',compact('masa','div','naskah'));
    }

    public function store(Request $request)
    {
        $user_id = $request->users_id;

        $this->validate($request,[
            'uraian' => 'required'
        ]);

        DB::beginTransaction();
            $dokument   = Archives::create($request->all());
            $doc_id     = $dokument->id;
            if($request->hasFile('file')){ // Kalau file ada
                $request->file('file')
                            ->move('images/arsiparis/'.$doc_id,$request
                            ->file('file')
                            ->getClientOriginalName()); 
                $dokument->file = $request->file('file')->getClientOriginalName(); 
                $dokument->save();
            }

            for ($i = 0; $i < count($request->input('attachfile')); $i++){
                $data = [
                    'archives_id' => $doc_id,
                    'attachfile' => $request->attachfile[$i],
                ];
                Archives_att::create($data);

            }
        DB::commit(); 


        return redirect('/arsip/archivesrek')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $div = Divisi::where('id','!=','1')->get();
        $masa = Mailclasification::all();
        $data = Archives::where('id',$id)->first();
        $naskah = Naskah::all();
        $detail = Archives_att::where('archives_id',$id)->get();
        return view('arsip/archivesrek.edit',compact('data','masa','div','naskah','detail'));
    }


    public function update(Request $request, $id)
    {
        $user_id = $request->users_id;
        $data = Archives::find($id);
        $data->touch();

        DB::beginTransaction(); 
            $data->update($request->all());

            if($request->hasFile('file')){ // Kalau file ada
                $request->file('file')
                            ->move('images/arsiparis/'.$data->id,$request
                            ->file('file')
                            ->getClientOriginalName()); 
                $data->file = $request->file('file')->getClientOriginalName(); 
                $data->save();
            }

            for ($i = 0; $i < count($request->input('attachfile')); $i++){
                $detail = [
                    'archives_id' => $id,
                    'attachfile'  => $request->attachfile[$i],
                ];
                Archives_att::updateOrCreate([
                  'id'   => $request->outemp_id[$i],
                ],$detail);
            }
            DB::commit(); 

        return redirect('/arsip/archivesrek')->with('sukses','Data Diperbaharui');

    }
    
    public function delete($id)
    {
        $data = Archives::find($id);
        $data->delete();
        return redirect('/arsip/archivesrek')->with('sukses','Data Terhapus');
    }

      
    public function deleteper($id)
    {
        $data = Archives::find($id);
        $data->forceDelete();
        return redirect('/arsip/archivesrek')->with('sukses','Data Terhapus');
    }

    public function deletelist($id)
    {
        $data = Archives_att::find($id);
        $div = $data->divisi_id;
        return redirect('/arsip/archives/bidang/'.$div)->with('sukses','Data Terhapus');
        $data->Delete();
    }

}
