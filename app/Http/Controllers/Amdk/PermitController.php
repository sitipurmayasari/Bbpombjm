<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\Absensi;

class PermitController extends Controller
{
    public function index(Request $request)
    {
        $peg =auth()->user()->id;
        $nowbln = (Carbon::now()->month);
        $nowthn = (Carbon::now()->year);
        $bln = $nowbln-1;
        if ($bln == 0) {
           $thn = $nowthn-1;
           $bulan = 12;
        } else {
           $bulan = $bln;
           $thn = $nowthn;
        }


        $datalalu = Absensi::orderBy('tanggal','asc')
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
                        ->where('users.id',$peg)
                        ->where('periode_year',$thn)
                        ->where('periode_month',$bulan)
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('name','LIKE','%'.$request->keyword.'%');
                            })
                        ->paginate('25');
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
                        ->where('users.id',$peg)
                        ->where('periode_year',$nowthn)
                        ->where('periode_month',$nowbln)
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('name','LIKE','%'.$request->keyword.'%');
                            })
                        ->paginate('25');
                return view('amdk/permit.index',compact('data','datalalu'));
    }

    public function create()
    {
        // $kategori = Agenda_kategori::All();
        return view('amdk/permit.create');
    }
 
    // public function store(Request $request)
    // {
    //     $this->validate($request,[
    //         'agenda_kategori_id' => 'required',
    //         'titles' => 'required',
    //         'detail' => 'required',
    //         'date_from' => 'required',
    //         'date_to' => 'required'
    //     ]);
    //     Agenda::create($request->all());
    //     return redirect('/amdk/permit')->with('sukses','Data Tersimpan');
    // }
   
    // public function edit($id)
    // {
    //     $kategori = Agenda_kategori::All();
    //     $data = Agenda::where('id',$id)->first();
    //     return view('amdk/permit.edit',compact('data','kategori'));
    // }

   
    // public function update(Request $request, $id)
    // {
    //     $data = Agenda::find($id);
    //     $data->update($request->all());
    //     return redirect('/amdk/permit')->with('sukses','Data Diperbaharui');
    // }

    // public function delete($id)
    // {
    //     $data = Agenda::find($id);
    //     $data->delete();
    //     return redirect('/amdk/permit')->with('sukses','Data Terhapus');

    // }
}
