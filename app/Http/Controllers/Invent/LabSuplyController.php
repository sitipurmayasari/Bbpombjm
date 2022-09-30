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

class LabSuplyController extends Controller
{
    public function index(Request $request)
    {
        $data = Inventaris::orderBy('inventaris.id','desc')
                    ->selectRaw('inventaris.*, users.name')
                    ->leftJoin('users','users.id','=','inventaris.penanggung_jawab')
                    ->leftJoin('entrystock','entrystock.inventaris_id','=','inventaris.id')
                    ->where('inventaris.kind','=','L')
                    ->groupBy('inventaris.id')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('nama_barang','LIKE','%'.$request->keyword.'%')
                                ->orWhere('merk', 'LIKE','%'.$request->keyword.'%')
                                ->where('inventaris.kind','=','L')
                                ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('invent/labsuply.index',compact('data'));
    }

    public function create()
    {

        $divisi = Divisi::all();
        $user = User::all()
        ->where('id','!=','1');
        $lokasi = Lokasi::all();
        $jenis = Jenisbrg::where('kelompok','L')->get();
        $satuan = Satuan::WhereRaw('id not IN (2,3,4,6)')->get();

        return view('invent/labsuply.create',compact('divisi','user','lokasi','jenis','satuan'));
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
        return redirect('/invent/labsuply')->with('sukses','Data Tersimpan');
    }

    public function qrcode($id)
    {
        $data = Inventaris::where('id',$id)->first();
        
        return view('invent/inventaris.qrcode',compact('data'));
    }
   

    public function edit($id)
    {
        $satuan = Satuan::WhereRaw('id not IN (2,3,4,6)')->get();
        $data = Inventaris::where('id',$id)->first();
        $divisi = Divisi::all();
        $user = User::all()
                ->where('id','!=','1');
        $lokasi = Lokasi::all();
        $jenis = Jenisbrg::where('kelompok','L')->get();
        return view('invent/labsuply.edit',compact('data','divisi','user','lokasi','jenis','satuan'));
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

        return redirect('/invent/labsuply')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $inventaris = Inventaris::find($id);
        $inventaris->delete();
        return redirect('/invent/labsuply')->with('sukses','Data Terhapus');
    }

    public function stock($id)
    {

        $stok = Entrystock::orderBy('entry_date','desc')
                    ->where('inventaris_id',$id)
                    ->get();
        $data = Inventaris::where('id',$id)->first();
        $sisa = Entrystock::orderby('id','desc')
                        ->where('inventaris_id',$id)
                        ->first();
    return view('invent/labsuply.stock',compact('data','stok','sisa'));
    }

    public function storestock(Request $request)
    {
        $this->validate($request,[
            'entry_date' => 'required',
            'stock'      => 'required',
            'exp_date'   => 'required',
        ]);
        $stok = Entrystock::create($request->all());
        return redirect('/invent/labsuply/stock/'.$stok->inventaris_id)->with('sukses','Data Tersimpan');
    }

    public function ubahstok($id)
    {
        $data = Entrystock::where('id',$id)->first();
        return view('invent/labsuply.ubahstok',compact('data'));
    }

    public function updatestok(Request $request, $id)
    {
        $data = Entrystock::find($id);
        $data->update($request->all());
        return redirect('/invent/labsuply/stock/'.$data->inventaris_id)->with('sukses','Data Tersimpan');
    }

    public function deletestock($id)
    {
        $data = Entrystock::find($id); 
        $data->delete();
        return redirect('/invent/labsuply/stock/'.$data->inventaris_id)->with('sukses','Data Terhapus');
    }

}
