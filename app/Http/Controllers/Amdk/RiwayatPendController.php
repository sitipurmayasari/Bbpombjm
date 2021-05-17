<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\RiwayatPend;
use App\Pendidikan;
use App\Jurusan;

class RiwayatPendController extends Controller
{
    public function index(Request $request)
    {
        $user = User::all();
        $jenjang = Pendidikan::all();  
        $jurusan = Jurusan::all();       
        $data = RiwayatPend::orderBy('id','desc')
                ->paginate('10');
        return view('amdk/riwayatpend.index',compact('data','user','jenjang','jurusan'));
    }

    public function getData(Request $request)
    {
        $user_id = $request->user_id;
        $riwayat = RiwayatPend::orderBy('pendidikan.id','asc')
                ->select('riwayat_pend.*', 'pendidikan.jenjang', 'jurusan.jurusan')
                ->leftJoin('pendidikan','riwayat_pend.pendidikan_id','=','pendidikan.id')
                ->leftJoin('jurusan','riwayat_pend.jurusan_id','=','jurusan.id')
                ->where('riwayat_pend.users_id',$user_id)
                ->get();

        return response()->json([ 
            'success' => true,
            'riwayat'=>$riwayat
            
        ],200);
    }

    public function store(Request $request)
    {
        $user_id = $request->users_id;   
        RiwayatPend::create($request->all());
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }

    public function datapen(Request $request)
    {
        $id = $request->id;
        $data = RiwayatPend::where('riwayat_pend.id',$id)
                ->select('riwayat_pend.*', 'pendidikan.jenjang', 'jurusan.jurusan')
                ->leftJoin('pendidikan','riwayat_pend.pendidikan_id','=','pendidikan.id')
                ->leftJoin('jurusan','riwayat_pend.jurusan_id','=','jurusan.id')
                ->first();

        return response()->json([ 'success' => true,'data' => $data],200);
    }


    public function delete($id)
    {
        $data = RiwayatPend::find($id);
        $user_id = $data->users_id;
        $data->delete();
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }

    public function update(Request $request, $id)
    {
        $user_id = $request->users_id;
        $data = RiwayatPend::find($id);
        $data->update($request->all());
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }


  
}
