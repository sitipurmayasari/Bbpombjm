<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Inventaris;
use App\Labory;
use App\Bpla;
use PDF;
class BPLAController extends Controller
{
    public function index(Request $request)
    {
        $lab = labory::all();
        $user = User::where('id','!=','1')
                    ->where('aktif','Y')
                    ->get();
        return view('invent/bpla.index',compact('lab', 'user'));
    }

    public function cetak(Request $request)
    { 
        if($request->jenis_Laporan=="1"){
            $peg = User::where('id',$request->user_id)->first();
            $data = Bpla::where('user_id',$request->user_id)
                        ->when($request->daftartahun, function ($query) use ($request) {
                            $query->whereYear('dates',$request->daftartahun);
                        })
                        ->when($request->bulan, function ($query) use ($request) {
                            if($request->bulan==2){
                                $query->whereMonth('dates',$request->daftarbulan);
                            }
                        })
                        ->get();
            $pdf = PDF::loadview('invent/bpla.peruser',compact('data','request','peg'));
            return $pdf->stream();

        }else{
            $lab = Labory::where('id',$request->labory_id)->first();
            $data = Bpla::where('labory_id',$request->labory_id)
                        ->when($request->daftartahun, function ($query) use ($request) {
                            $query->whereYear('dates',$request->daftartahun);
                        })
                        ->when($request->bulan, function ($query) use ($request) {
                            if($request->bulan==2){
                                $query->whereMonth('dates',$request->daftarbulan);
                            }
                        })
                        ->get();
            $pdf = PDF::loadview('invent/bpla.perlab',compact('data','request','lab'));
            return $pdf->stream();
        }
    }


}
