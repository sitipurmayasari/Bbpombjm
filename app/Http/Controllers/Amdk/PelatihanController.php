<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Pelatihan;
use App\Jenis_pelatihan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PDF;

class PelatihanController extends Controller
{

    public function index(Request $request)
    {
        $peg =auth()->user()->id;
        $data = Pelatihan::orderBy('id','desc')
                        ->select('pelatihan.*')
                        ->leftjoin('jenis_pelatihan','jenis_pelatihan.id','pelatihan.jenis_pelatihan_id')
                        ->where('pelatihan.users_id','=',$peg)
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('nama','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('dari', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('sampai', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('lama', 'LIKE','%'.$request->keyword.'%');
                            })
                        ->paginate('10');
        return view('amdk/pelatihan.index',compact('data'));
    }

    public function rekappelatihan(Request $request)
    {
       
        $user = User::all();
        $jenis = Jenis_pelatihan::all();
        $data = Pelatihan::orderBy('id','desc')
                ->select('pelatihan.*','users.name')
                ->leftJoin('users','users.id','=','pelatihan.users_id')
                ->leftjoin('jenis_pelatihan','jenis_pelatihan.id','pelatihan.jenis_pelatihan_id')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('users.name','LIKE','%'.$request->keyword.'%')
                            ->orWhere('nama', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('jenis_pelatihan.name', 'LIKE','%'.$request->keyword.'%') 
                            ->orWhere('dari', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('sampai', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('lama', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('amdk/pelatihan.rekappelatihan',compact('data','user','jenis'));
    }

    public function create()
    {
        $user = User::all();
        $jenis = Jenis_pelatihan::all();
        return view('amdk/pelatihan.create',compact('user','jenis'));
    }

    public function createadmin()
    {
        $user = User::all()
                ->where('id','!=','1');
        $jenis = Jenis_pelatihan::all();
        return view('amdk/pelatihan.createadmin',compact('user','jenis'));
    }

    public function rekap()
    {
        $user = User::all();
        $jenis = Jenis_pelatihan::all();
        return view('amdk/pelatihan.rekap',compact('user','jenis'));
    }


    public function store(Request $request)
    {
        $user_id = $request->users_id;

        $this->validate($request,[
            'users_id' => 'required',
            'nama' => 'required',
            'jenis_pelatihan_id' => 'required',
            'dari' => 'required',
            'sampai' => 'required',
            'lama' => 'required',
            'file'  => 'max:2048'
        ]);

        $dokument = Pelatihan::create($request->all());
        if($request->hasFile('file')){ // Kalau file ada
            $request->file('file')
                        ->move('images/pegawai/'.$dokument->users_id.'/sertifikat',$request
                        ->file('file')
                        ->getClientOriginalName()); 
            $dokument->file = $request->file('file')->getClientOriginalName(); 
            $dokument->save(); 
        }

        if ($request->admin=='true') {
            return redirect('/amdk/rekappelatihan')->with('sukses','Data Tersimpan');
        }
            return redirect('/amdk/pelatihan')->with('sukses','Data Tersimpan');
        
    }

    public function edit($id)
    {
        $data = Pelatihan::where('id',$id)->first();
        $jenis = Jenis_pelatihan::all();
        return view('amdk/pelatihan.edit',compact('data','jenis'));
    }

    public function editadmin($id)
    {
        $user = User::all();
        $data = Pelatihan::where('id',$id)->first();
        $jenis = Jenis_pelatihan::all();
        return view('amdk/pelatihan.editadmin',compact('data','user','jenis'));
    }


    public function update(Request $request, $id)
    {
        $user_id = $request->users_id;
        $data = Pelatihan::find($id);
        $data->update($request->all());
        if($request->hasFile('file')){ // Kalau file ada
            $request->file('file')
                        ->move('images/pegawai/'.$data->users_id.'/sertifikat',$request
                        ->file('file')
                        ->getClientOriginalName()); 
            $data->file = $request->file('file')->getClientOriginalName(); 
            $data->save(); 
        }

        if ($request->admin=='true') {
            return redirect('/amdk/rekappelatihan')->with('sukses','Data Diperbaharui');
        }
            return redirect('/amdk/pelatihan')->with('sukses','Data Diperbaharui');

    }

    
    public function delete($id)
    {
        $data = Pelatihan::find($id);
        $data->delete();
        return redirect('/amdk/pelatihan')->with('sukses','Data Terhapus');
    }


    public function cetak(Request $request)
    {
        
        if ($request->peg==1) {
            $data = Pelatihan::orderBy('users_id','asc')
                                ->selectRaw('sum(lama) AS poin , users_id')
                                ->WhereRaw("YEAR(dari) =".$request->daftartahun)
                                ->groupBy('users_id')
                                ->get();
            $pdf = PDF::loadview('amdk/pelatihan.cetakall',compact('data','request'));
            return $pdf->stream();
        }else{
            $atas = Pelatihan::orderBy('id','asc')
                    ->where('users_id', $request->user)
                    ->WhereRaw("YEAR(dari) =".$request->daftartahun)
                    ->first();
            $data = Pelatihan::orderBy('id','asc')
                    ->where('users_id', $request->user)
                    ->WhereRaw("YEAR(dari) =".$request->daftartahun)
                    ->get();
            $total = Pelatihan::selectRaw('SUM(lama) as jumlah')
                    ->where('users_id', $request->user)
                    ->WhereRaw("YEAR(dari) =".$request->daftartahun)
                    ->first();
            $pdf = PDF::loadview('amdk/pelatihan.cetakpeg',compact('data','request','total','atas'));
            return $pdf->stream();
        }
    }




}
