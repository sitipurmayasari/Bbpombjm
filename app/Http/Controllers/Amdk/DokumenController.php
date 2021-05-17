<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Jendok;
use App\Dokumen;

class DokumenController extends Controller
{
    public function index(Request $request)
    {
        $user = User::all();
        $jenis = Jendok::all();
        $data = Dokumen::orderBy('id','desc')
                ->paginate('10');
        return view('amdk/dokumen.index',compact('user','jenis','data'));
    }

    public function getData(Request $request)
    {
        $user_id = $request->user_id;
        $dok = Dokumen::orderBy('dokumen.id','asc')
                ->select('dokumen.*', 'jendok.nama')
                ->leftJoin('jendok','dokumen.jendok_id','=','jendok.id')
                ->where('dokumen.users_id',$user_id)
                ->get();

        return response()->json([ 
            'success' => true,
            'dok'=>$dok
            
        ],200);
    }
    
    public function store(Request $request)
    {
        $user_id = $request->users_id;

        $this->validate($request,[
            'nomor' => 'required',
            'jendok_id' => 'required',
            'tanggal' => 'required',
            'upload' => 'required'
        ]);

        $dokument = Dokumen::create($request->all());
        if($request->hasFile('upload')){ // Kalau file ada
            $request->file('upload')
                        ->move('images/pegawai/'.$dokument->users_id.'/dokument',$request
                        ->file('upload')
                        ->getClientOriginalName()); 
            $dokument->upload = $request->file('upload')->getClientOriginalName(); 
            $dokument->save(); 
        }

        if ($request->profile=='true') {
            return redirect('/profile')->with('sukses','Pengalaman anda diperbaharui');
        }
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }

    public function datadok(Request $request)
    {
        $id = $request->id;
        $data = Dokumen::where('dokumen.id',$id)
                ->select('dokumen.*', 'jendok.nama')
                ->leftJoin('jendok','dokumen.jendok_id','=','jendok.id')
                ->first();

        return response()->json([ 'success' => true,'data' => $data],200);
    }
   
    public function update(Request $request, $id)
    {
        $user_id = $request->users_id;
        $data = Dokumen::find($id);
        $data->update($request->all());
        if($request->hasFile('upload')){ // Kalau file ada
            $request->file('upload')
                        ->move('images/pegawai/'.$data->users_id.'/dokument',$request
                        ->file('upload')
                        ->getClientOriginalName()); 
            $data->upload = $request->file('upload')->getClientOriginalName(); 
            $data->save(); 
        }


        if ($request->profile=='true') {
            return redirect('/profile')->with('sukses','Pengalaman anda diperbaharui');
        }
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Dokumen::find($id);
        $user_id = $data->users_id;
        $data->delete();
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }
}
