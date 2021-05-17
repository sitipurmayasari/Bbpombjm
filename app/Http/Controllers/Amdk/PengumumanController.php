<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Pengumuman;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $user = User::all();
        $data = Pengumuman::orderBy('id','desc')
                ->select('pengumuman.*','users.name')
                ->leftJoin('users','users.id','=','pengumuman.users_id')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('judul','LIKE','%'.$request->keyword.'%')
                            ->orWhere('name', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('dari', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('sampai', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('amdk/pengumuman.index',compact('data','user'));
    }

    public function create()
    {
        $user = User::all();
        return view('amdk/pengumuman.create',compact('user'));
    }

    public function store(Request $request)
    {
        Pengumuman::create($request->all());
        return redirect('/amdk/pengumuman')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $user = User::all();
        $data = Pengumuman::where('id',$id)->first();
        return view('amdk/pengumuman.edit',compact('data','user'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Pengumuman::find($id);
        $data->update($request->all());
        return redirect('/amdk/pengumuman')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $pengumuman = Pengumuman::find($id);
        $pengumuman->delete();
        return redirect('/amdk/pengumuman')->with('sukses','Data Terhapus');
    }
}
