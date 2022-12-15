<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use LogActivity;
use App\Setupttd;
use App\User;

class SetTTDController extends Controller
{
    public function index(Request $request)
    {
        $data = Setupttd::orderBy('id','desc')
                ->paginate('10');
        return view('amdk/setupttd.index',compact('data'));
    }

    public function create()
    {
        $user = User::where('aktif','Y')->where('status','PNS')->get();
        return view('amdk/setupttd.create',compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'scan_ttd' => 'mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = Setupttd::create($request->all());

        if($request->hasFile('scan_ttd')){ // Kalau file ada
            $request->file('scan_ttd')
                        ->move('images/ttd/'.$data->id,$request
                        ->file('scan_ttd')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $data->scan_ttd = $request->file('scan_ttd')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $data->save(); // save ke database
        }


        LogActivity::addToLog('Simpan-Setup Tanda Tangan, id = '.$data->id);
        
        return redirect('/amdk/setupttd')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $user = User::where('aktif','Y')->where('status','PNS')->get();
        $data = Setupttd::where('id',$id)->first();
        return view('amdk/setupttd.edit',compact('data','user'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Setupttd::find($id);
        $data->update($request->all());

        LogActivity::addToLog('Ubah-Setup Tanda Tangan, id = '.$id);

        return redirect('/amdk/setupttd')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Setupttd::find($id);
        $data->delete();

        LogActivity::addToLog('Hapus-Setup Tanda Tangan, id = '.$id);

        return redirect('/amdk/setupttd')->with('sukses','Data Terhapus');
    }
}
