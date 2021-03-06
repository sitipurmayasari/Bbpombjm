<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Dupak;
use App\Golongan;
use App\Pejabat;
use App\Jabasn;
use App\Credit_poin;
use App\RiwayatPend;
use PDF;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DupakController extends Controller
{

    public function index(Request $request)
    {
        $data = Dupak::orderBy('id','desc')
                ->select('dupak.*','users.name')
                ->leftJoin('users','users.id','=','dupak.users_id')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('name','LIKE','%'.$request->keyword.'%')
                            ->orWhere('tanggal', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('nomor_kp', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('amdk/dupak.index',compact('data'));
    }

    public function kredit(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;
        $data = Dupak::orderBy('id','desc')
                ->select('dupak.*','users.name')
                ->leftJoin('users','users.id','=','dupak.users_id')
                ->where('users_id', $id)
                ->where('dupak.file', '!=','NULL')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('name','LIKE','%'.$request->keyword.'%')
                            ->orWhere('tanggal', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('nomor_kp', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('amdk/dupak.kredit',compact('data'));
    }

    public function create()
    {
        $jabasn = Jabasn::where('kelompok','Pengawas Farmasi Dan Makanan')->get();
        $user = User::all();
        $gol = Golongan::all();
        return view('amdk/dupak.create',compact('user','gol','jabasn'));
    }

    public function getDataPeg(Request $request)
    {
        $user_id = $request->users_id;
        $riwayat = User::orderBy('riwayat_pend.id','desc')
                ->selectRaw('users.name,users.seri_karpeg, riwayat_pend.jurusan_id, golongan.ruang, golongan.golongan, jurusan.jurusan, jabasn.nama as jafung,
                            (SELECT total FROM dupak WHERE users_id ='.$user_id.' ORDER BY id DESC LIMIT 1) jl')
                ->leftJoin('golongan','golongan.id','=','users.golongan_id')
                ->leftJoin('riwayat_pend','riwayat_pend.users_id','=','users.id')
                ->leftJoin('jurusan','riwayat_pend.jurusan_id','=','jurusan.id')
                ->leftJoin('dupak','dupak.users_id','=','users.id')
                ->leftJoin('jabasn','jabasn.id','=','users.jabasn_id')
                ->where('users.id', $user_id)
                ->first();

        return response()->json([ 
            'success' => true,
            'riwayat'=>$riwayat
        ],200);
    }

    public function store(Request $request)
    {
        $rapel = $request->rapel;

        $user_id = $request->users_id;

        $this->validate($request,[
            'users_id' => 'required',
            'seri_karpeg' => 'required',
            'tmt' => 'required',
            'nomor_kp' => 'required|unique:dupak',
            'dari' => 'required',
            'sampai' => 'required',
            'masa_lama_thn' => 'required',
            'masa_lama_bln' => 'required',
            'masa_baru_thn' => 'required',
            'masa_baru_bln' => 'required',
            'tanggal' => 'required'
        ]);
        DB::beginTransaction();
            $dokument = Dupak::create($request->all());
            if($request->hasFile('file')){ // Kalau file ada
                $request->file('file')
                            ->move('images/pegawai/'.$dokument->users_id.'/dupak',$request
                            ->file('file')
                            ->getClientOriginalName()); 
                $dokument->file = $request->file('file')->getClientOriginalName(); 
                $dokument->save(); 
            }

            if ($rapel != "Y") {
                $request->merge(['dupak_id' => $dokument->id]);
                Credit_poin::create($request->all());
            }
        DB::commit(); 
        return redirect('/amdk/dupak')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $jabasn = Jabasn::where('kelompok','Pengawas Farmasi Dan Makanan')->get();
        $user = User::all();
        $gol = Golongan::all();
        $data = Dupak::orderBy('riwayat_pend.id','desc')
                    ->select('dupak.*', 'golongan.ruang', 'golongan.golongan', 'jurusan.jurusan')
                    ->leftJoin('users','users.id','=','dupak.users_id')
                    ->leftJoin('golongan','golongan.id','=','users.golongan_id')
                    ->leftJoin('riwayat_pend','riwayat_pend.users_id','=','users.id')
                    ->leftJoin('jurusan','riwayat_pend.jurusan_id','=','jurusan.id')
                    ->where('dupak.id', $id)
                    ->first();
        return view('amdk/dupak.edit',compact('data','user','gol','jabasn'));
    }


    public function update(Request $request, $id)
    {
        $rapel = $request->rapel;
        $user_id = $request->users_id;
        $data = Dupak::find($id);
        $data->update($request->all());
        if($request->hasFile('file')){ // Kalau file ada
            $request->file('file')
                        ->move('images/pegawai/'.$data->users_id.'/dupak',$request
                        ->file('file')
                        ->getClientOriginalName()); 
            $data->file = $request->file('file')->getClientOriginalName(); 
            $data->save(); 
        }

        if ($rapel != 'Y') {
            $rap = [
                'dari' => $request->dari,
                'sampai' => $request->sampai,
                'jumlah' => $request->jumlah
            ];
            Credit_poin::where('dupak_id',$id)
            ->update($rap);

        }else{
            Credit_poin::create($request->all());
        }


        return redirect('/amdk/dupak')->with('sukses','Data Diperbaharui');

    }

    
    public function delete($id)
    {
        $data = Dupak::find($id);
        $data->delete();
        return redirect('/amdk/dupak')->with('sukses','Data Terhapus');
    }


    public function print($id)
    {
        $data = Dupak::where('id',$id)->first();
        $pend = RiwayatPend::orderBy('id','desc')
                ->whereRaw("users_id = (SELECT users_id FROM dupak WHERE id = $id)")->first();
        $mengetahui = Pejabat::
                    where('jabatan_id', '=', 6)
                    ->where('divisi_id', '=', 1)
                    ->whereRaw("(SELECT tanggal FROM dupak WHERE id=$id) BETWEEN dari AND sampai")
                    ->first();
        $pdf = PDF::loadview('amdk/dupak.print',compact('data','mengetahui','pend'));
        return $pdf->stream();
    }




}
