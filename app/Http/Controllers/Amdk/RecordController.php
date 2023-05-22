<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Pengalaman;
use App\RiwayatPend;
use App\Pelatihan;
use PDF;

class RecordController extends Controller
{
    public function index(Request $request)
    {
        $pns = User::OrderBy('name','asc')
                    ->where('status','PNS')
                    ->where('aktif','Y')
                    ->where('id','!=','1')
                    ->WhereRaw('jabatan_id NOT IN (1,9,10)')
                    ->get();
        $ppnpn = User::OrderBy('name','asc')
                    ->where('status','PPNPN')
                    ->where('aktif','Y')
                    ->where('id','!=','1')
                    ->WhereRaw('jabatan_id NOT IN (1,9,10)')
                    ->get();
        return view('amdk/record.index',compact('pns','ppnpn'));
    }

    public function cetak(Request $request)
    {
        if ($request->peg=="1") {
            $data = User::where('id',$request->pns)->first();
            $pend = RiwayatPend::orderBy('id','desc')
                                ->where('users_id',$request->pns)->first();
            $pengalaman = Pengalaman::where('users_id',$request->pns)->get();
            $pendidikan = RiwayatPend::where('users_id',$request->pns)->get();
            $pelatihan = Pelatihan::where('users_id',$request->pns)->get();

            return view('amdk/record.cetak',compact('data','request','pendidikan','pengalaman','pelatihan','pend'));

        }elseif($request->peg=="2"){
            $data = User::where('id',$request->ppnpn)->first();
            $pend = RiwayatPend::orderBy('id','desc')
                                ->where('users_id',$request->ppnpn)->first();
            $pengalaman = Pengalaman::where('users_id',$request->ppnpn)->get();
            $pendidikan = RiwayatPend::where('users_id',$request->ppnpn)->get();
            $pelatihan = Pelatihan::where('users_id',$request->ppnpn)->get();

            return view('amdk/record.cetak2',compact('data','request','pendidikan','pengalaman','pelatihan','pend'));          
        } else {
            dd($request->all());

        }            
    } 
}
