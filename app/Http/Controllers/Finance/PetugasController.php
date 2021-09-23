<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Petugas;
use App\User;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $user = User::all()
                ->where('id','!=','1');
        $data = Petugas::orderBy('id','desc')
                ->paginate('10');
        return view('finance/petugas.index',compact('data','user'));
    }

    public function store(Request $request)
    {
        
        petugas::create($request->all());
        return redirect('/finance/petugas')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $user = User::all()
                ->where('id','!=','1');
        $data = Petugas::where('id',$id)->first();
        return view('finance/petugas.edit',compact('data','user'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Petugas::find($id);
        $data->update($request->all());
        return redirect('/finance/petugas')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Petugas::find($id);
        $petugas->delete();
        return redirect('/finance/petugas')->with('sukses','Data Terhapus');
    }
}
