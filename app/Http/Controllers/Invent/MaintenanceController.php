<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventaris;
use App\User;
use App\Divisi;
use App\Pindahtangan;
use App\Lokasi;
use App\Pejabat;
use PDF;
use LogActivity;

class MaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $data = Pindahtangan::orderBy('id','desc')
                            ->select('pindahtangan.*','inventaris.nama_barang', 'inventaris.merk')
                            ->leftJoin('inventaris','inventaris.id','=','pindahtangan.inventaris_id')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('inventaris.nama_barang','LIKE','%'.$request->keyword.'%')
                                         ->orWhere('pindahtangan.nomor', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('inventaris.merk', 'LIKE','%'.$request->keyword.'%');
                            })
                            ->paginate('10');
        return view('invent/maintenance.index',compact('data'));
    }

    public function create()
    {
        $user = User::where('id','!=','1')->where('aktif','Y')->get();
        $div  = Divisi::all();
        $lokasi = Lokasi::all();
        return view('invent/maintenance.create',compact('user','div','lokasi'));
    }
   
    public function store(Request $request)
    {
        $this->validate($request,[
            'nomor' => 'required|unique:pindahtangan',
        ]);
        Pindahtangan::create($request->all());

        $data = [
            'penanggung_jawab' => $request->baru_id,
            'lokasi' => $request->lokasi
        ];
        Inventaris::updateOrCreate([
          'id'   => $request->inventaris_id
        ],$data);

        LogActivity::addToLog('Simpan->BA Pemindah tanganan BMN, nomor = '.$request->nomor);

        return redirect('/invent/maintenance')->with('sukses','Data Tersimpan');
    }


   
    public function edit($id)
    {
        $user = User::where('id','!=','1')->where('aktif','Y')->get();
        $div  = Divisi::all();
        $lokasi = Lokasi::all();
        $data = Pindahtangan::where('id',$id)->first();

        if ($data->kelompok == 'lab') {
            $inv = Inventaris::orderBy('inventaris.id','desc')
                                ->where('inventaris.kind','=','R')
                                ->where('inventaris.jenis_barang','=','22')
                                ->get();
        } elseif ($data->kelompok == 'tik') {
            $inv = Inventaris::orderBy('inventaris.id','desc')
                                ->where('inventaris.kind','=','R')
                                ->where('inventaris.jenis_barang','=','4')
                                ->get();
        } elseif ($data->kelompok == 'motor') {
            $inv = Inventaris::orderBy('inventaris.id','desc')
                                ->where('inventaris.kind','=','R')
                                ->where('inventaris.jenis_barang','=','19')
                                ->get();
        } else {
            $inv = Inventaris::orderBy('inventaris.id','desc')
                                ->where('inventaris.kind','=','R')
                                ->whereraw('inventaris.jenis_barang not in (22,4,19')
                                ->get();
        }
        return view('invent/maintenance.edit',compact('data','user','div','lokasi','inv'));
    }

    public function update(Request $request, $id)
    {
        $ba = Pindahtangan::find($id);
        $ba->update($request->all());

        $data = [
            'penanggung_jawab' => $request->baru_id,
            'lokasi' => $request->lokasi
        ];
        Inventaris::updateOrCreate([
          'id'   => $request->inventaris_id
        ],$data);

        LogActivity::addToLog('Ubah->BA Pemindah tanganan BMN, nomor = '.$request->nomor);

        return redirect('/invent/maintenance')->with('sukses','Data Diperbaharui');

    }
   
    public function delete($id)
    {
        $main = Pindahtangan::find($id);

        LogActivity::addToLog('Hapus->BA Pemindah tanganan BMN, nomor = '.$main->nomor);
        $main->delete();

        return redirect('/invent/maintenance')->with('sukses','Data Terhapus');

    }

    public function getKelompok(Request $request)
    {
        $kelompok = $request->kelompok;

        if ($kelompok == 'lab') {
            $data = Inventaris::orderBy('inventaris.id','desc')
                                ->where('inventaris.kind','=','R')
                                ->where('inventaris.jenis_barang','=','22')
                                ->get();
        } elseif ($kelompok == 'tik') {
            $data = Inventaris::orderBy('inventaris.id','desc')
                                ->where('inventaris.kind','=','R')
                                ->where('inventaris.jenis_barang','=','4')
                                ->get();
        } elseif ($kelompok == 'motor') {
            $data = Inventaris::orderBy('inventaris.id','desc')
                                ->where('inventaris.kind','=','R')
                                ->where('inventaris.jenis_barang','=','19')
                                ->get();
        } else {
            $data = Inventaris::orderBy('inventaris.id','desc')
                                ->where('inventaris.kind','=','R')
                                ->whereraw('inventaris.jenis_barang not in (22,4,19')
                                ->get();
        }
        return response()->json([ 'success' => true,'data' => $data],200);
    }

    public function cetak($id)
    {
        $data = Pindahtangan::where("id",$id)->first();
        $mengetahui = Pejabat::orderBy("id","desc")
                            ->whereraw("jabatan_id = 6 and pjs IS NULL")
                            ->first();
        $pdf = PDF::loadview('invent/maintenance.cetak',compact('data','mengetahui'));
        return $pdf->stream();
    }

}
