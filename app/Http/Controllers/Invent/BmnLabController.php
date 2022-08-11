<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventaris;
use App\Divisi;
use App\User;
use App\Lokasi;
use App\JadwalMain;
use App\Satuan;
use App\Jenisbrg;
use Illuminate\Support\Facades\DB;
use QrCode;
use Illuminate\Support\Facades\Crypt;


class BmnLabController extends Controller
{
    public function index(Request $request)
    {
        $data = Inventaris::orderBy('inventaris.id','desc')
                    ->select('inventaris.*','users.name')
                    ->leftJoin('users','users.id','=','inventaris.penanggung_jawab')
                    ->leftJoin('lokasi','lokasi.id','=','inventaris.lokasi')
                    ->where('inventaris.kind','=','R')
                    ->where('inventaris.jenis_barang','=','22')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('nama_barang','LIKE','%'.$request->keyword.'%')
                                ->orWhere('merk', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('lokasi.nama', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('users.name', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('invent/bmnlab.index',compact('data'));
    }

    public function create()
    {

        $divisi = Divisi::all();
        $user = User::all()
        ->where('id','!=','1');
        $lokasi = Lokasi::all();
        $jenis = Jenisbrg::all();
        $satuan = Satuan::all();

        return view('invent/bmnlab.create',compact('divisi','user','lokasi','jenis','satuan'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'kode_barang' => 'required|unique:inventaris',
            'file_user_manual' => 'mimes:pdf|max:10048',
            'file_trouble' => 'mimes:pdf|max:10048',
            'file_ika' => 'mimes:pdf|max:10048',
            'file_foto' => 'mimes:jpg,png,jpeg|max:2048',
            'tanggal_diterima' => 'required|date'
        ]);

        $inventaris =Inventaris::create($request->all());

        if($request->hasFile('file_user_manual')){ // Kalau file ada
            $request->file('file_user_manual')
                        ->move('images/inventaris/'.$inventaris->id,$request
                        ->file('file_user_manual')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $inventaris->file_user_manual = $request->file('file_user_manual')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $inventaris->save(); // save ke database
        }

        if($request->hasFile('file_trouble')){ // Kalau file ada
            $request->file('file_trouble')
                        ->move('images/inventaris/'.$inventaris->id,$request
                        ->file('file_trouble')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $inventaris->file_trouble = $request->file('file_trouble')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $inventaris->save(); // save ke database
        }

        if($request->hasFile('file_ika')){ // Kalau file ada
            $request->file('file_ika')
                        ->move('images/inventaris/'.$inventaris->id,$request
                        ->file('file_ika')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $inventaris->file_ika = $request->file('file_ika')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $inventaris->save(); // save ke database
        }

        if($request->hasFile('file_sert')){ // Kalau file ada
            $request->file('file_sert')
                        ->move('images/inventaris/'.$inventaris->id,$request
                        ->file('file_sert')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $inventaris->file_sert = $request->file('file_sert')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $inventaris->save(); // save ke database
        }

        if($request->hasFile('file_foto')){ // Kalau file ada
            $request->file('file_foto')
                        ->move('images/inventaris/'.$inventaris->id,$request
                        ->file('file_foto')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $inventaris->file_foto = $request->file('file_foto')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $inventaris->save(); // save ke database
        }
        return redirect('/invent/bmnlab')->with('sukses','Data Tersimpan');
    }

    public function jadwal($id)
    {

        $jadwal = JadwalMain::orderBy('id','asc')
                    ->where('inventaris_id',$id)
                    ->get();
        $data = Inventaris::where('id',$id)->first();

        return view('invent/bmnlab.jadwal',compact('data','jadwal'));
    }

    public function storejadwal(Request $request)
    {
        $jadwal = JadwalMain::create($request->all());
        return redirect('/invent/bmnlab/jadwal/'.$jadwal->inventaris_id)->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $satuan = Satuan::all();
        $data = Inventaris::where('id',$id)->first();
        $divisi = Divisi::all();
        $user = User::all()
                ->where('id','!=','1');
        $lokasi = Lokasi::all();
        $jenis = Jenisbrg::all();
        return view('invent/bmnlab.edit',compact('data','divisi','user','lokasi','jenis','satuan'));
    }

    public function detail($idEncy)
    {
    //    $id = Crypt::decrypt($idEncy);
        try {
            $id = Crypt::decryptString($idEncy);
            $satuan = Satuan::all();
            $data = Inventaris::where('id',$id)->first();
            if ($data) {
                $divisi = Divisi::all();
                $user = User::all()
                        ->where('id','!=','1');
                $lokasi = Lokasi::all();
                $jenis = Jenisbrg::all();
                return view('invent/bmnlab.detail',compact('data','divisi','user','lokasi','jenis','satuan'));
            }else{
                return view('404');
            }
        }catch (DecryptException $e) {
            return view('404');
        }

    }


    public function update(Request $request, $id)
    {
         $this->validate($request,[
            'file_user_manual2' => 'mimes:pdf|max:10048',
            'file_trouble2' => 'mimes:pdf|max:10048',
            'file_ika2' => 'mimes:pdf|max:10048',
            'file_foto2' => 'mimes:jpg,png,jpeg|max:2048',
            'tanggal_diterima' => 'required|date'

        ]);


        $inventaris = Inventaris::find($id);
        $inventaris->update($request->all());
        if($request->hasFile('file_user_manual2')){ // Kalau file ada
            $request->file('file_user_manual2')
                        ->move('images/inventaris/'.$inventaris->id,$request
                        ->file('file_user_manual2')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $inventaris->file_user_manual = $request->file('file_user_manual2')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $inventaris->save(); // save ke database
        }

        if($request->hasFile('file_trouble2')){ // Kalau file ada
            $request->file('file_trouble2')
                        ->move('images/inventaris/'.$inventaris->id,$request
                        ->file('file_trouble2')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $inventaris->file_trouble = $request->file('file_trouble2')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $inventaris->save(); // save ke database
        }

        if($request->hasFile('file_ika2')){ // Kalau file ada
            $request->file('file_ika2')
                        ->move('images/inventaris/'.$inventaris->id,$request
                        ->file('file_ika2')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $inventaris->file_ika = $request->file('file_ika2')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $inventaris->save(); // save ke database
        }

        if($request->hasFile('file_sert2')){ // Kalau file ada
            $request->file('file_sert2')
                        ->move('images/inventaris/'.$inventaris->id,$request
                        ->file('file_sert2')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $inventaris->file_sert = $request->file('file_sert2')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $inventaris->save(); // save ke database
        }

        if($request->hasFile('file_foto2')){ // Kalau file ada
            $request->file('file_foto2')
                        ->move('images/inventaris/'.$inventaris->id,$request
                        ->file('file_foto2')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $inventaris->file_foto = $request->file('file_foto2')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $inventaris->save(); // save ke database
        }



        return redirect('/invent/bmnlab')->with('sukses','Data Diperbaharui');
    }


    public function delete($id)
    {
        $inventaris = Inventaris::find($id);
        $inventaris->delete();
        return redirect('/invent/bmnlab')->with('sukses','Data Terhapus');
    }

    public function deleteJadwal($id)
    {
        $jadwalMain = JadwalMain::find($id);
        $inventaris_id = $jadwalMain->inventaris_id;
        $jadwalMain->delete();
        return redirect('/invent/bmnlab/jadwal/'.$inventaris_id)->with('sukses','Data Terhapus');
    }

    //JSON get data barang 200 is success api
    public function getBarang(Request $request)
    {
        $id = $request->barang_id;

        $data = DB::table('inventaris')
            ->leftJoin('lokasi', 'inventaris.lokasi', '=', 'lokasi.id')
            ->leftJoin('users', 'inventaris.penanggung_jawab', '=', 'users.id')
            ->leftJoin('satuan', 'inventaris.satuan_id', '=', 'satuan.id')
            ->select('inventaris.*', 'lokasi.nama as bola', 'users.name','satuan.satuan')
            ->where('inventaris.id',$id)->first();
        return response()->json([ 'success' => true,'data' => $data],200);
    }
}
