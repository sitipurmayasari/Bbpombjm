<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Anak;
use App\Orangtua;
use App\Mertua;
use App\Saudara;
use App\Pasangan;
use App\Jurusan;
use App\Pendidikan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;



class KeluargaController extends Controller
{
    public function index(Request $request)
    {
        $user = User::all();
        $pend = Jurusan::all();
        $jenjang = Pendidikan::all();
        return view('amdk/keluarga.index',compact('user','pend','jenjang'));
    }

    
    public function storeortu(Request $request)
    {
        $user_id = $request->users_id;
        DB::beginTransaction();
        Orangtua::where('users_id',$user_id)->delete();
        Orangtua::create($request->all());
        DB::commit(); 

        if ($request->profile=='true') {
            return redirect('/profile')->with('sukses','Pengalaman anda diperbaharui');
        }
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }

    public function storemertua(Request $request)
    {
        $user_id = $request->users_id;
        DB::beginTransaction();
        Mertua::where('users_id',$user_id)->delete();
        Mertua::create($request->all());
        DB::commit(); 

        if ($request->profile=='true') {
            return redirect('/profile')->with('sukses','Pengalaman anda diperbaharui');
        }
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }

    public function storeistri(Request $request)
    {
        $user_id = $request->users_id;
        DB::beginTransaction();
        Pasangan::where('users_id',$user_id)->delete();
        Pasangan::create($request->all());
        DB::commit(); 

        if ($request->profile=='true') {
            return redirect('/profile')->with('sukses','Pengalaman anda diperbaharui');
        }
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }

    public function storeanak(Request $request)
    {
        $user_id = $request->users_id;
        Anak::create($request->all());

        if ($request->profile=='true') {
            return redirect('/profile')->with('sukses','Pengalaman anda diperbaharui');
        }
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }

    public function storesaudara(Request $request)
    {
        $user_id = $request->users_id;
        Saudara::create($request->all());

        if ($request->profile=='true') {
            return redirect('/profile')->with('sukses','Pengalaman anda diperbaharui');
        }
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }

  
   
    public function getKeluarga(Request $request)
    {
        $user_id = $request->user_id;

        $ortu = Orangtua::
                where('users_id',$user_id)
                ->first();

        $mertua = Mertua::
                where('users_id',$user_id)
                ->first();

        $anak = Anak::orderBy('tgl_lhr_anak','asc')
                ->select('anak.*','pendidikan.jenjang', 'jurusan.jurusan','anak.id as itu')
                ->leftJoin('pendidikan','anak.pendidikan_id_anak','=','pendidikan.id')
                ->leftJoin('jurusan','anak.jurusan_id_anak','=','jurusan.id')
                ->where('anak.users_id',$user_id)
                ->get();

        $istri = Pasangan::
                select('pasangan.*', 'jurusan.jurusan')
                ->leftJoin('jurusan','pasangan.jurusan_id_psg','=','jurusan.id')
                ->where('pasangan.users_id',$user_id)
                ->first();

        $saudara = Saudara::orderBy('tgl_lhr_saudara','asc')
                ->where('users_id',$user_id)
                ->get();

        return response()->json([ 
            'success' => true,
            'ortu'=>$ortu,
            'anak'=>$anak,
            'istri'=>$istri,
            'saudara'=>$saudara,
            'mertua'=>$mertua
           
            
        ],200);
    }


    public function dataperanak(Request $request)
    {
        $id = $request->id;
        $data = Anak::where('anak.id',$id)
                ->select('anak.*','pendidikan.jenjang', 'jurusan.jurusan','anak.id as itu')
                ->leftJoin('pendidikan','anak.pendidikan_id_anak','=','pendidikan.id')
                ->leftJoin('jurusan','anak.jurusan_id_anak','=','jurusan.id')
                ->first();

        return response()->json([ 'success' => true,'data' => $data],200);
    }


    public function datapersaudara(Request $request)
    {
        $id = $request->id;
        $data = Saudara::where('id',$id)
                ->first();

        return response()->json([ 'success' => true,'data' => $data],200);
    }


    public function updateanak(Request $request, $id)
    {
        
        $user_id = $request->users_id;
        $data = Anak::find($id);
        $data->update($request->all());
        if ($request->profile=='true') {
            return redirect('/profile')->with('sukses','Pengalaman anda diperbaharui');
        }
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }

    public function updatesaudara(Request $request, $id)
    {
        $user_id = $request->users_id;
        $data = Saudara::find($id);
        $data->update($request->all());

        if ($request->profile=='true') {
            return redirect('/profile')->with('sukses','Pengalaman anda diperbaharui');
        }
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }
   
    public function deleteanak($id)
    {
        $data = Anak::find($id);
        $user_id = $data->users_id;
        $data->delete();
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');

    }

    public function deletesaudara($id)
    {
        $data = Saudara::find($id);
        $user_id = $data->users_id;
        $data->delete();
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');

    }

    
}
