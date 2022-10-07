<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ItAsset;
use App\User;
use App\Jenistik;
use Illuminate\Support\Facades\DB;
use QrCode;
use Illuminate\Support\Facades\Crypt;


class ITAssetController extends Controller
{
    public function index(Request $request)
    {
        $data = ItAsset::orderBy('itasset.id','desc')
                    ->select('itasset.*')
                    ->leftJoin('users','users.id','=','itasset.users_id')
                    ->leftJoin('jenistik','jenistik.id','=','itasset.jenistik_id')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('nama_barang','LIKE','%'.$request->keyword.'%')
                                ->orWhere('kode_barang', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('jenistik.kelompok', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('lokasi', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('users.name', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('invent/itasset.index',compact('data'));
    }

    public function create()
    {
        $user = User::where('id','!=','1')->where('aktif','Y')->get();
        $jenis = Jenistik::all();
        return view('invent/itasset.create',compact('user','jenis'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'kode_barang' => 'required|unique:itasset',
            'file_foto' => 'mimes:jpg,png,jpeg|max:2048',
        ]);

        $asset =ItAsset::create($request->all());

        if($request->hasFile('file_foto')){ 
            $request->file('file_foto')
                        ->move('images/itasset/'.$asset->id,$request
                        ->file('file_foto')
                        ->getClientOriginalName()); 
            $asset->file_foto = $request->file('file_foto')->getClientOriginalName(); 
            $asset->save(); 
        }
        return redirect('/invent/itasset')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $data = ItAsset::where('id',$id)->first();
        $user = User::where('id','!=','1')->get();
        $jenis = Jenistik::all();
        return view('invent/itasset.edit',compact('data','user','jenis'));
    }

    public function update(Request $request, $id)
    {
         $this->validate($request,[
            'file_foto2' => 'mimes:jpg,png,jpeg|max:2048'

        ]);

        $asset = ItAsset::find($id);
        $asset->update($request->all());

        if($request->hasFile('file_foto2')){
            $request->file('file_foto2')
                        ->move('images/itasset/'.$asset->id,$request
                        ->file('file_foto2')
                        ->getClientOriginalName()); 
            $asset->file_foto = $request->file('file_foto2')->getClientOriginalName(); 
            $asset->save(); 
        }



        return redirect('/invent/itasset')->with('sukses','Data Diperbaharui');
    }

    public function delete($id)
    {
        $asset = ItAsset::find($id);
        $asset->delete();
        return redirect('/invent/itasset')->with('sukses','Data Terhapus');
    }


    //JSON get data barang 200 is success api
    public function getBarangTIK(Request $request)
    {
        $id = $request->barang_id;
        $data = ItAsset::orderBy('itasset.id','desc')
                        ->select('itasset.*, users.name as pj')
                        ->leftJoin('users','users.id','=','itasset.users_id')
                        ->leftJoin('jenistik','jenistik.id','=','itasset.jenistik_id')
                        ->where('itasset.id',$id)
                        ->first();
        return response()->json([ 'success' => true,'data' => $data],200);
    }
}
