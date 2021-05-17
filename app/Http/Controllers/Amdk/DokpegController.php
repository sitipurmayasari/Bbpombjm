<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Jendok;
use App\Dokpeg;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DokpegController extends Controller
{

    public function getData(Request $request)
    {
        $user_id = $request->user_id;
        $dok_peg = Dokpeg::orderBy('id','asc')
                ->select('*',
                            DB::raw('(CASE WHEN jendok_id = 1 THEN "SK CPNS" WHEN jendok_id = 2 THEN "SK PNS"
                                        WHEN jendok_id = 2 THEN "SK KENAIKAN JABATAN" ELSE "SK KENAIKAN PANGKAT"
                            END) AS jenis')
                         )
                ->where('users_id',$user_id)
                ->get();
        return response()->json([ 
            'success' => true,
            'dok_peg'=>$dok_peg
            
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

        $dokument = Dokpeg::create($request->all());
        if($request->hasFile('upload')){ // Kalau file ada
            $request->file('upload')
                        ->move('images/pegawai/'.$dokument->users_id.'/dok_kepegawaian',$request
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

    public function datadokpeg(Request $request)
    {
        $id = $request->id;
        $data = Dokpeg::where('id',$id)
                ->first();
        return response()->json([ 'success' => true,'data' => $data],200);
    }
   
    public function update(Request $request, $id)
    {
        $user_id = $request->users_id;
        $data = Dokpeg::find($id);
        $data->update($request->all());
        if($request->hasFile('upload')){ // Kalau file ada
            $request->file('upload')
                        ->move('images/pegawai/'.$data->users_id.'/dok_kepegawaian',$request
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
        $data = Dokpeg::find($id);
        $user_id = $data->users_id;
        $data->delete();
        return redirect('/amdk/pegawai/detail/'.$user_id)->with('sukses','Data Diperbaharui');
    }
}
