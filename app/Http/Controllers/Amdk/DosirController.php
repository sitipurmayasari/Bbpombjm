<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Dosir;
use App\Archive_time;

class DosirController extends Controller
{

    public function index(Request $request)
    {
        $peg =auth()->user()->id;
        $data = Dosir::SelectRaw('Dosir.* , Archive_time.masa_aktif, CURDATE() AS hari_ini,
                            DATE_ADD(DATE(dosir.created_at),INTERVAL Archive_time.masa_aktif YEAR) batas_aktif')
                    ->orderBy('dosir.id','desc')
                    ->leftJoin('Archive_time','Archive_time.id','=','dosir.Archive_time_id')
                    ->where('users_id','=',$peg)
                    ->whereRaw('CURDATE() BETWEEN DATE(dosir.created_at) 
                            and DATE_ADD(DATE(dosir.created_at),INTERVAL Archive_time.masa_aktif YEAR)')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('dosir.nama','LIKE','%'.$request->keyword.'%')
                                ->orWhere('Archive_time.nama', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('created_at', 'LIKE','%'.$request->keyword.'%');
                        })
                    ->paginate('10');
        return view('amdk/dosir.index',compact('data','user'));
    }

    public function rekapdosir(Request $request)
    {

        $masa = Archive_time::all();
        $user = User::all();
        $data = Dosir::SelectRaw('Dosir.*,
                    CASE
                        WHEN 
                            curdate() > DATE_ADD(dosir.created_at,INTERVAL Archive_time.masa_aktif YEAR) 
                            AND CURDATE() < DATE_ADD(dosir.created_at,INTERVAL 
                            (Archive_time.masa_aktif + Archive_time.masa_pasif) YEAR)
                            THEN "Pasif"
                        WHEN 
                            curdate() > DATE_ADD(dosir.created_at,INTERVAL 
                            (Archive_time.masa_aktif + Archive_time.masa_pasif) YEAR) then "Kadaluarsa"
                        ELSE "Aktif"
                    END status        
                ')
                ->orderBy('dosir.id','desc')
                ->leftJoin('users','users.id','=','dosir.users_id')
                ->leftJoin('Archive_time','Archive_time.id','=','dosir.Archive_time_id')
                ->whereraw('curdate() > DATE_ADD(dosir.created_at,INTERVAL Archive_time.masa_aktif YEAR)')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('dosir.nama','LIKE','%'.$request->keyword.'%')
                            ->orWhere('users.name', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('Archive_time.nama', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('dosir.created_at', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('amdk/dosir.rekapdosir',compact('data','user','masa'));
    }

    public function create()
    {
        $masa = Archive_time::all();
        return view('amdk/dosir.create',compact('masa'));
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

        return redirect('/amdk/dosir')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $masa = Archive_time::all();
        $data = Dosir::where('id',$id)->first();
        return view('amdk/dosir.edit',compact('data','masa'));
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


        return redirect('/amdk/dosir')->with('sukses','Data Diperbaharui');

    }

    
    public function delete($id)
    {
        $data = Dosir::find($id);
        $data->delete();
        return redirect('/amdk/dosir')->with('sukses','Data Terhapus');
    }




}
