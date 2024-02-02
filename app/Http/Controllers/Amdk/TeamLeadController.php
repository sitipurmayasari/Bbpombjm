<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Divisi;
use App\Teamleader;
use LogActivity;

class TeamLeadController extends Controller
{
    public function index(Request $request)
    {
        $data = Teamleader::orderBy('id','desc')
                ->select('teamleader.*','users.name','divisi.nama')
                ->leftJoin('users','users.id','=','teamleader.users_id')
                ->leftJoin('divisi','divisi.id','=','teamleader.divisi_id')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('detail','LIKE','%'.$request->keyword.'%')
                            ->orWhere('name', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('nama', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('amdk/teamlead.index',compact('data'));
    }

    public function create()
    {
        $divisi = Divisi::all();
        $user = User::where('status','PNS')
                ->where('aktif','Y')->get();
        return view('amdk/teamlead.create',compact('divisi','user'));
    }

    public function store(Request $request)
    {
        Teamleader::create($request->all());
        
        LogActivity::addToLog('Simpan->Ketua Tim->detail ='.$request->detail);
        return redirect('/amdk/teamlead')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $divisi = Divisi::all();
        $user = User::where('status','PNS')
        ->where('aktif','Y')->get();
        $data = Teamleader::where('id',$id)->first();
        return view('amdk/teamlead.edit',compact('data','divisi','user'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Teamleader::find($id);
        $data->update($request->all());

        LogActivity::addToLog('Ubah->Ketua Tim->id ='.$data->id); 
        return redirect('/amdk/teamlead')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Teamleader::find($id);
        LogActivity::addToLog('Hapus->Ketua Tim->id = '.$data->detail); 

        $data->delete();
       
        return redirect('/amdk/teamlead')->with('sukses','Data Terhapus');
    }
}
