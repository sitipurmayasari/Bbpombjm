<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Pengalaman;

class PengalamanController extends Controller
{
    public function index(Request $request)
    {
        $user = User::all();
        $data = Pengalaman::orderBy('id','desc')
                ->paginate('10');
        return view('amdk/pengalaman.index',compact('user','data'));
    }

    public function getData(Request $request)
    {
        $user_id = $request->user_id;
        $kerja = Pengalaman::
                where('users_id',$user_id)
                ->get();

        return response()->json([ 
            'success' => true,
            'kerja'=>$kerja
            
        ],200);
    }
    
    public function store(Request $request)
    {
        $user_id = $request->users_id;   
        Pengalaman::create($request->all());

        if ($request->profile=='true') {
            return redirect('/profile')->with('sukses','Pengalaman anda diperbaharui');
        }
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }

    public function dataker(Request $request)
    {
        $id = $request->id;
        $data =  Pengalaman::where('id',$id)
                ->first();

        return response()->json([ 'success' => true,'data' => $data],200);
    }
   
   
    public function update(Request $request, $id)
    {
        $user_id = $request->users_id;
        $data = Pengalaman::find($id);
        $data->update($request->all());

        if ($request->profile=='true') {
            return redirect('/profile')->with('sukses','Pengalaman anda diperbaharui');
        }
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Pengalaman::find($id);
        $user_id = $data->users_id;
        $data->delete();
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }


    
}
