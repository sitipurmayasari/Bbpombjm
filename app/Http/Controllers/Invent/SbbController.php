<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Dosir;
use App\Archive_time;
use PDF;
use App\Divisi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SbbController extends Controller
{
    
    public function index(Request $request)
    {
        $div =auth()->user()->divisi_id;
        $data = Dosir::SelectRaw('dosir.* , archive_time.masa_aktif, CURDATE() AS hari_ini,
                            DATE_ADD(DATE(dosir.created_at),INTERVAL archive_time.masa_aktif YEAR) batas_aktif')
                    ->orderBy('dosir.id','desc')
                    ->leftJoin('archive_time','archive_time.id','=','dosir.archive_time_id')
                    ->where('archive_time_id','=','6')
                    ->where('divisi_id','=',$div)
                    ->whereRaw('CURDATE() BETWEEN DATE(dosir.created_at) 
                            and DATE_ADD(DATE(dosir.created_at),INTERVAL archive_time.masa_aktif YEAR)')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('dosir.nama','LIKE','%'.$request->keyword.'%')
                                ->orWhere('archive_time.nama', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('created_at', 'LIKE','%'.$request->keyword.'%');
                        })
                    ->paginate('10');
        $divisi = Divisi::where('id',$div)->first();
        return view('invent/sbbfiles.index',compact('data','divisi'));
    }

    public function create()
    {
        $masa = Archive_time::all();
        return view('invent/sbbfiles.create',compact('masa'));
    }

    public function store(Request $request)
    {
        $user_id = $request->users_id;

        $this->validate($request,[
            'users_id' => 'required',
            'nama' => 'required',
            'file' => 'required'
        ]);

        $dokument = Dosir::create($request->all());
        if($request->hasFile('file')){ // Kalau file ada
            $request->file('file')
                        ->move('images/pegawai/'.$dokument->users_id.'/dosir',$request
                        ->file('file')
                        ->getClientOriginalName()); 
            $dokument->file = $request->file('file')->getClientOriginalName(); 
            $dokument->save(); 
        }

        return redirect('/invent/sbbfiles')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $masa = Archive_time::all();
        $data = Dosir::where('id',$id)->first();
        return view('invent/sbbfiles.edit',compact('data','masa'));
    }


    public function update(Request $request, $id)
    {
        $user_id = $request->users_id;
        $data = Dosir::find($id);
        $data->update($request->all());
        if($request->hasFile('file')){ // Kalau file ada
            $request->file('file')
                        ->move('images/pegawai/'.$data->users_id.'/dosir',$request
                        ->file('file')
                        ->getClientOriginalName()); 
            $data->upload = $request->file('file')->getClientOriginalName(); 
            $data->save(); 
        }


        return redirect('/invent/sbbfiles')->with('sukses','Data Diperbaharui');

    }

    
    public function delete($id)
    {
        $data = Dosir::find($id);
        $data->delete();
        return redirect('/invent/sbbfiles')->with('sukses','Data Terhapus');
    }

}
