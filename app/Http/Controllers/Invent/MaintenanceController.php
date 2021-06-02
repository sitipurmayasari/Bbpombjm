<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventaris;
use App\Maintenance;
use App\User;

class MaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('id','!=','1');
        $barang = Inventaris::all();
        $data = Maintenance::orderBy('id','desc')
                            ->select('pemeliharaan.*','users.name', 'inventaris.nama_barang', 'inventaris.merk')
                            ->leftJoin('users','users.id','=','pemeliharaan.pegawai_id')
                            ->leftJoin('inventaris','inventaris.id','=','pemeliharaan.inventaris_id')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('inventaris.nama_barang','LIKE','%'.$request->keyword.'%')
                                         ->orWhere('pemeliharaan.no_pemeliharaan', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('inventaris.merk', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('users.name', 'LIKE','%'.$request->keyword.'%');
                            })
                            ->paginate('10');
        return view('invent/maintenance.index',compact('data','user','barang'));
    }

    public function create()
    {
        $data = Inventaris::all();
        $user = User::all()
        ->where('id','!=','1');
        return view('invent/maintenance.create',compact('data','user'));
    }
   
    public function store(Request $request)
    {
        $this->validate($request,[
            'no_pemeliharaan' => 'required|unique:pemeliharaan',
            'tgl_pelihara' => 'required|unique:pemeliharaan'
        ]);
        Maintenance::create($request->all());
        return redirect('/invent/maintenance')->with('sukses','Data Tersimpan');
    }


   
    public function edit($id)
    {
        $inv = Inventaris::all();
        $user = User::all()
                ->where('id','!=','1');
        $data = Maintenance::where('id',$id)->first();
        return view('invent/maintenance.edit',compact('data','user','inv'));
    }

   
    public function update(Request $request, $id)
    {

        $data = Maintenance::find($id);
        $data->update($request->all());
        return redirect('/invent/maintenance')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $main = Maintenance::find($id);
        $main->delete();
        return redirect('/invent/maintenance')->with('sukses','Data Terhapus');

    }
}
