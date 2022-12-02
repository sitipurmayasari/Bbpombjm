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
use PDF;

class RekpermitController extends Controller
{
    public function index(Request $request)
    {
        $bln = (Carbon::now()->month)-1;
        if ($bln == 0) {
           $thn = (Carbon::now()->year)-1;
           $bulan = 12;
        } else {
           $bulan = $bln;
           $thn = (Carbon::now()->year);
        }

        $data = Absensi::SelectRaw('users_id, sum(poin) poin, SUM((HOUR(terlambat)*60)+MINUTE(terlambat)) lambat, SUM((HOUR(pulang_cepat)*60)+MINUTE(pulang_cepat)) cepat')
                        ->LeftJoin('users','users.id','absensi.users_id')
                        ->where('periode_year',$thn)
                        ->where('periode_month',$bulan)
                        ->where('users.aktif','Y')
                        ->groupby('users_id')
                        ->orderby('poin','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('name','LIKE','%'.$request->keyword.'%');
                            })
                        ->paginate('10');
        return view('amdk/rekpermit.index',compact('data', 'bulan','thn'));
    }

    public function daftar($users_id, $bln, $thn)
    {
        $data = Absensi::orderBy('tanggal','asc')
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
                        ->where('periode_year',$thn)
                        ->where('periode_month',$bln)
                        ->where('users_id',$users_id)
                        ->get();
        return view('amdk/rekpermit.daftar',compact('data'));
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

        return redirect('/amdk/rekpermit/daftar/'.$data->users_id.'/'.$data->periode_month.'/'.$data->periode_year)->with('sukses','Data Diperbaharui');
    }

    public function rekap()
    {
        $user = User::where('status','PPNPN')->where('id','!=','1')->get(); 
        return view('amdk/rekpermit.rekap',compact('user'));
    }

    public function cetak(Request $request)
    {
       if ($request->peg == 1) {
        $data = Absensi::SelectRaw('users_id, sum(poin) poin, SUM((HOUR(terlambat)*60)+MINUTE(terlambat)) lambat, SUM((HOUR(pulang_cepat)*60)+MINUTE(pulang_cepat)) cepat')
                        ->where('periode_year',$request->tahun)
                        ->where('periode_month',$request->bulan)
                        ->groupby('users_id')
                        ->orderby('poin','desc')
                        ->get();
        $pdf = PDF::loadview('amdk/rekpermit.cetak1',compact('data','request'));
        return $pdf->stream();

       } elseif ($request->peg == 2) {
        $data = Absensi::where('users_id',$request->user)
                        ->where('periode_year',$request->tahun)
                        ->where('periode_month',$request->bulan)
                        ->get();
        $total = Absensi::SelectRaw('SUM(poin) poin')
                        ->where('users_id',$request->user)
                        ->where('periode_year',$request->tahun)
                        ->where('periode_month',$request->bulan)
                        ->first();
        $pulang = Absensi::SelectRaw('SUM((HOUR(pulang_cepat)*60)+MINUTE(pulang_cepat)) total')
                        ->where('users_id',$request->user)
                        ->where('periode_year',$request->tahun)
                        ->where('periode_month',$request->bulan)
                        ->first();
        $lambat = Absensi::SelectRaw('SUM((HOUR(terlambat)*60)+MINUTE(terlambat)) total')
                        ->where('users_id',$request->user)
                        ->where('periode_year',$request->tahun)
                        ->where('periode_month',$request->bulan)
                        ->first();
        $pdf = PDF::loadview('amdk/rekpermit.cetak2',compact('data','request','total','pulang','lambat'));
        return $pdf->stream();
       }else{
        dd($request->all());
       }
       
    }

}
