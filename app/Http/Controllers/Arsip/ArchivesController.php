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
use App\Naskah;

class ArchivesController extends Controller
{

    public function index(Request $request)
    {
        $divisi = Divisi::where('id','!=','1')->get();
        return view('arsip/archives.index',compact('divisi'));
    }

    public function bidang(Request $request ,$id)
    {
        $div = Divisi::where('id',$id)->first();
        $data = Archives::selectraw('archives.*, mailclasification.alias,mailclasification.names,
                                    CURDATE() AS hari_ini,
                                    DATE_ADD(DATE(archives.date),INTERVAL mailclasification.actived YEAR) batas_aktif')
                        ->orderBy('archives.id','desc')
                        ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                        ->where('divisi_id','=',$id)
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('uraian','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                            })
                        ->paginate('10');
        return view('arsip/archives.bidang',compact('data','div'));
    }

    public function create($id)
    {
        $div = Divisi::where('id',$id)->first();
        $masa = Mailclasification::all();
        $naskah = Naskah::all();
        return view('arsip/archives.create',compact('masa','div','naskah'));
    }

    public function store(Request $request, $id)
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

        return redirect('/arsip/archives/bidang/'.$dokument->divisi_id)->with('sukses','Data Tersimpan');
    }

    public function edit($div, $id)
    {
        $div = Divisi::where('id',$div)->first();
        $masa = Mailclasification::all();
        $data = Archives::where('id',$id)->first();
        $naskah = Naskah::all();
        $detail = Archives_att::where('archives_id',$id)->get();
        return view('arsip/archives.edit',compact('data','masa','div','naskah','detail'));
    }


    public function update(Request $request, $div, $id)
    {
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

        return redirect('/arsip/archives/bidang/'.$div)->with('sukses','Data Diperbaharui');

    }

    
    public function delete($id)
    {
        $data = Archives::find($id);
        $data->forceDelete();
        return redirect('/arsip/archives')->with('sukses','Data Terhapus');
    }

    
    public function deletelist($id)
    {
        $data = Archives_att::find($id);
        $div = $data->divisi_id;
        return redirect('/arsip/archives/bidang/'.$div)->with('sukses','Data Terhapus');
        $data->Delete();
    }




}
