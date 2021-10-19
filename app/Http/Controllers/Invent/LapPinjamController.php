<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Divisi;
use App\User;
use App\Car;
use App\Vehiclerent;
use PDF;
class LapPinjamController extends Controller
{
    public function index()
    {
        return view('invent/lappinjam.index');
    }
    public function cetak(Request $request)
    {
        if ($request->jenis_Laporan=="daftar") {
            $data   = Car::orderBy('id','desc')
                            ->get();
            $pdf = PDF::loadview('invent/lappinjam.cetakdaftar',compact('data'));
            return $pdf->stream();

        }elseif($request->jenis_Laporan=="pinjam"){
            $data   = Vehiclerent::orderBy('created_at','desc')
                                ->where('status','=','Y')
                                ->when($request->tahun, function ($query) use ($request) {
                                    if($request->tahun==2){
                                        $query->whereYear('date_from',$request->daftartahun);
                                    }
                                })
                                ->get();

            $pdf = PDF::loadview('invent/lappinjam.cetakpinjam',compact('data','request'));
            return $pdf->stream();

        } else {
            dd($request->all());

        }            
    } 
}
