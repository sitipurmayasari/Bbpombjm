<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Dupak;
use App\Golongan;
use App\Pejabat;
use App\Jabasn;
use PDF;

class RekDupakController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('status','PNS')
                ->where('aktif','Y')
                ->get();
        $jabasn = Jabasn::where('kelompok','Pengawas Farmasi Dan Makanan')->get();
        return view('amdk/rekapdupak.index',compact('user','jabasn'));
    }


    public function cetak(Request $request)
    {
        if($request->jenis=="1"){
            $blndupak= Dupak::selectRaw('month(dari) AS bulan, YEAR(dari) AS tahun, dari')
                    ->orderBy('dari','asc')
                    ->groupByRaw('dari')
                    ->get();
            $thndupak= Dupak::selectRaw('YEAR(dari) AS tahun')
                    ->orderBy('tahun','asc')
                    ->groupByRaw('tahun')
                    ->get();
            $peg= Dupak::selectRaw('distinct dupak.users_id')
                    ->groupByRaw('dupak.users_id')
                    ->leftJoin('users','users.id','=','dupak.users_id')
                    ->where('users.aktif','Y')
                    ->orderBy('users_id','asc')
                    ->get();

            $pdf = PDF::loadview('amdk/rekapdupak.umum',compact('thndupak','blndupak','peg'));
            return $pdf->stream();

        }else if($request->jenis=="2" && $request->pegawai !=null){
            $data = User::where('id',$request->pegawai)
                        ->first();
            $dupak = Dupak::selectRaw('*, month(dari) AS bulan, YEAR(dari) AS tahun')
                        ->where('users_id',$request->pegawai)
                        ->get();
           
            $pdf = PDF::loadview('amdk/rekapdupak.personil',compact('data','dupak'));
            return $pdf->stream();
        
        }else if($request->jenis=="3" && $request->poin !=null){

            if ($request->poin== 'a') {
                $start  = 0;
                $end    = 93; 
            } else if ($request->poin== 'b') {
                $start  = 94;
                $end    = 185; 
            } else if ($request->poin== 'c') {
                $start  = 185;
                $end    = 370; 
            } else if ($request->poin== 'd') {
                $start  = 370;
                $end    = 735; 
            } else {
               $start = 735;
               $end = 999;
            }
            

            $blndupak= Dupak::selectRaw('month(dari) AS bulan, YEAR(dari) AS tahun, dari')
                    ->orderBy('dari','asc')
                    ->groupByRaw('dari')
                    ->get();
            $thndupak= Dupak::selectRaw('YEAR(dari) AS tahun')
                    ->orderBy('tahun','asc')
                    ->groupByRaw('tahun')
                    ->get();
            $peg= User::selectRaw('*')
                    ->Join(DB::raw('(SELECT DISTINCT users_id, MAX(total) AS max FROM dupak GROUP BY users_id) AS tab'),
                            'tab.users_id','=','users.id')
                    ->where('users.aktif','=','Y')
                    ->where('tab.max','>=',$start)
                    ->where('tab.max','<',$end)
                    ->orderBy('users_id','asc')
                    ->get();
                    
            $pdf = PDF::loadview('amdk/rekapdupak.perpoin',compact('thndupak','blndupak','peg'));
                    return $pdf->stream();

        }else if($request->jenis=="4" && $request->jabasn !=null){
       
            $jab = Jabasn::where('id',$request->jabasn)
                            ->first();
            $blndupak= Dupak::selectRaw('month(dari) AS bulan, YEAR(dari) AS tahun, dari')
                            ->orderBy('dari','asc')
                            ->groupByRaw('dari')
                            ->get();
            $thndupak= Dupak::selectRaw('YEAR(dari) AS tahun')
                            ->orderBy('tahun','asc')
                            ->groupByRaw('tahun')
                            ->get();
             $peg= Dupak::selectRaw('distinct dupak.users_id')
                            ->groupByRaw('dupak.users_id')
                            ->leftJoin('users','users.id','=','dupak.users_id')
                            ->where('users.aktif','Y')
                            ->where('users.jabasn_id',$request->jabasn)
                            ->orderBy('users_id','asc')
                            ->get();
            $pdf = PDF::loadview('amdk/rekapdupak.perjab',compact('thndupak','blndupak','peg','jab'));
                            return $pdf->stream();

        }else{
            dd($request->all());
        }
    }

}
