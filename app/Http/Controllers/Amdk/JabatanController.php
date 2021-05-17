<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jabatan;
use App\User;
use App\Divisi;
use App\Subdivisi;
use App\Pejabat;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $subdivisi = Subdivisi::all();
        $jabatan = Jabatan::all();
        $divisi = Divisi::all();
        $user = User::all();
        $data = Pejabat::orderBy('id','desc')
                ->select('pejabat.*','users.name','jabatan.jabatan')
                ->leftJoin('users','users.id','=','pejabat.users_id')
                ->leftJoin('jabatan','jabatan.id','=','pejabat.jabatan_id')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('jabatan','LIKE','%'.$request->keyword.'%')
                            ->orWhere('name', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('dari', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('sampai', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('amdk/jabatan.index',compact('data','subdivisi','divisi','user','jabatan'));
    }

    public function create()
    {
        $subdivisi = Subdivisi::all();
        $jabatan = Jabatan::all();
        $divisi = Divisi::all();
        $user = User::all();
        return view('amdk/jabatan.create',compact('data','subdivisi','divisi','user','jabatan'));
    }

    public function store(Request $request)
    {
        pejabat::create($request->all());
        return redirect('/amdk/jabatan')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $subdivisi = Subdivisi::all();
        $jabatan = Jabatan::all();
        $divisi = Divisi::all();
        $user = User::all();
        $data = Pejabat::where('id',$id)->first();
        return view('amdk/jabatan.edit',compact('data','subdivisi','jabatan','divisi','user'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Pejabat::find($id);
        $data->update($request->all());
        return redirect('/amdk/jabatan')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $jabatan = Pejabat::find($id);
        $jabatan->delete();
        return redirect('/amdk/jabatan')->with('sukses','Data Terhapus');
    }
}
