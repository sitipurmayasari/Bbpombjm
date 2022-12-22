<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\Absensi;
use App\KetAbsen;
use LogActivity;

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

   
    public function edit($id)
    {
        $kets = KetAbsen::where('id','!=','1')->get();
        $data = Absensi::where('id',$id)->first();
        return view('amdk/permit.edit',compact('data','kets'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'file' => 'required|max:2048',
        ]);
        
        $data = Absensi::find($id);
        $data->update($request->all());
        if($request->hasFile('file')){ 
            $request->file('file')
                        ->move('images/daduk/'.$id,$request
                        ->file('file')
                        ->getClientOriginalName()); 
            $data->file = $request->file('file')->getClientOriginalName();
            $data->save();
          }

          LogActivity::addToLog('Update->Absensi Pramubakti, id = '.$id);
        
        return redirect('/amdk/permit')->with('sukses','Data Diperbaharui');
    }
}
