<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Absensi;
use App\User;
use App\KetAbsen;
use App\Libur;
use Excel;
use App\Imports\AbsenImport;
use LogActivity;

class RekpermitController extends Controller
{
    public function index(Request $request)
    {
        $data = Absensi::orderBy('id','desc')
                        ->SelectRaw('absensi.*, users.name,
                                    CASE
                                        WHEN periode_month = 1 THEN "Januari"
                                        WHEN periode_month = 2 THEN "februari"
                                        WHEN periode_month = 3 THEN "Maret"
                                        WHEN periode_month = 4 THEN "April"
                                        WHEN periode_month = 5 THEN "Mei"
                                        WHEN periode_month = 6 THEN "Juni"
                                        WHEN periode_month = 7 THEN "Juli"
                                        WHEN periode_month = 8 THEN "Agustus"
                                        WHEN periode_month = 9 THEN "September"
                                        WHEN periode_month = 10 THEN "Oktober"
                                        WHEN periode_month = 11 THEN "November"
                                        ELSE "Desember"
                                    END AS bulan ')
                        ->LeftJoin('users','users.id','absensi.users_id')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('name','LIKE','%'.$request->keyword.'%');
                            })
                        ->paginate('25');
        return view('amdk/rekpermit.index',compact('data'));
    }

    public function create()
    {
        // $kategori = Agenda_kategori::All(); 
        return view('amdk/rekpermit.create');
    }

    public function store(Request $request)
    {
        $bulan = $request->periode_month;
        $tahun = $request->periode_year;
       
        $this->validate($request, [
            'imporfile' => 'required|mimes:csv,xls,xlsx',
            'periode_month'   => 'required',
            'periode_year'   => 'required'
        ]);

        //proses import

        $file = $request->imporfile;
        $nama_file = $file->getClientOriginalName();

        $file->move('excel',$nama_file);

        DB::beginTransaction();

            Excel::import(new AbsenImport, public_path('/excel/'.$nama_file));
        
        DB::commit();

        //----------------
        LogActivity::addToLog('export data absensi periode '.$bulan.$tahun);

        return redirect('/amdk/rekpermit')->with('sukses','Data Berhasil Diimport');
 
    }
   
    public function edit($id)
    {
        $kets = KetAbsen::all();
        $data = Absensi::where('id',$id)->first();
        return view('amdk/rekpermit.edit',compact('data','kets'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Absensi::find($id);
        $data->update($request->all());
        LogActivity::addToLog('Update->Absensi, id = '.$id);

        return redirect('/amdk/rekpermit')->with('sukses','Data Diperbaharui');
    }

    public function rekap()
    {
        // $kategori = Agenda_kategori::All(); 
        return view('amdk/rekpermit.rekap');
    }
}
