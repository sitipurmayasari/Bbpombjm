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
use App\Entrystock;
use Illuminate\Support\Facades\DB;
use QrCode;

class DisposableController extends Controller
{
    public function index(Request $request)
    {
        $data = Inventaris::orderBy('inventaris.id','desc')
                    ->selectRaw('inventaris.*, users.name, SUM(entrystock.stock) AS stok')
                    ->leftJoin('users','users.id','=','inventaris.penanggung_jawab')
                    ->leftJoin('entrystock','entrystock.inventaris_id','=','inventaris.id')
                    ->where('inventaris.kind','=','D')
                    ->groupBy('inventaris.id')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('nama_barang','LIKE','%'.$request->keyword.'%')
                                ->orWhere('merk', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('invent/disposable.index',compact('data'));
    }

    public function create()
    {

        $divisi = Divisi::all();
        $user = User::where('id','!=','1')->get();
        $lokasi = Lokasi::all();
        $jenis = Jenisbrg::where('kelompok','K')->get();
        $satuan = Satuan::all();

        return view('invent/disposable.create',compact('divisi','user','lokasi','jenis','satuan'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'kode_barang' => 'required|unique:inventaris',
            'nama_barang' => 'required',
            'merk'        => 'required',
            'file_foto'   => 'mimes:jpg,png,jpeg|max:2048',
        ]);

        $inventaris =Inventaris::create($request->all());

        if($request->hasFile('file_foto')){ // Kalau file ada
            $request->file('file_foto')
                        ->move('images/inventaris/'.$inventaris->id,$request
                        ->file('file_foto')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $inventaris->file_foto = $request->file('file_foto')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $inventaris->save(); // save ke database
        }
        return redirect('/invent/disposable')->with('sukses','Data Tersimpan');
    }

    public function qrcode($id)
    {
        $data = Inventaris::where('id',$id)->first();
        
        return view('invent/inventaris.qrcode',compact('data'));
    }
   

    public function edit($id)
    {
        $satuan = Satuan::all();
        $data = Inventaris::where('id',$id)->first();
        $divisi = Divisi::all();
        $user = User::where('id','!=','1')->get();
        $lokasi = Lokasi::all();
        $jenis = Jenisbrg::where('kelompok','K')->get();
        return view('invent/disposable.edit',compact('data','divisi','user','lokasi','jenis','satuan'));
    }

    public function ubahstok($id)
    {
        $data = Entrystock::where('id',$id)->first();
        return view('invent/disposable.ubahstok',compact('data'));
    }

    public function updatestok(Request $request, $id)
    {
        $data = Entrystock::find($id);
        $data->update($request->all());

    }


    public function update(Request $request, $id)
    {
         $this->validate($request,[
            'file_foto2' => 'mimes:jpg,png,jpeg|max:2048'
        ]);


        $inventaris = Inventaris::find($id);
        $inventaris->update($request->all());

        if($request->hasFile('file_foto2')){ // Kalau file ada
            $request->file('file_foto2')
                        ->move('images/inventaris/'.$inventaris->id,$request
                        ->file('file_foto2')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $inventaris->file_foto = $request->file('file_foto2')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $inventaris->save(); // save ke database
        }

        return redirect('/invent/disposable')->with('sukses','Data Diperbaharui');
    }



  
   
    public function delete($id)
    {
        $inventaris = Inventaris::find($id);
        $inventaris->delete();
        return redirect('/invent/disposable')->with('sukses','Data Terhapus');
    }

    public function stock($id)
    {

        $stok = Entrystock::orderBy('id','asc')
                    ->where('inventaris_id',$id)
                    ->get();
        $data = Inventaris::where('id',$id)->first();
        
        return view('invent/disposable.stock',compact('data','stok'));
    }

    public function storestock(Request $request)
    {
        $this->validate($request,[
            'entry_date' => 'required',
            'stock'      => 'required',
            'exp_date'   => 'required',
        ]);
        $stok = Entrystock::create($request->all());
        return redirect('/invent/disposable/stock/'.$stok->inventaris_id)->with('sukses','Data Tersimpan');
    }
}
