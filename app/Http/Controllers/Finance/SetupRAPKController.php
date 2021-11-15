<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setuprenker;

class SetupRAPKController extends Controller
{
    public function index(Request $request)
    {
        $datasatu = Setuprenker::orderBy('id','desc')->where('jenis','Lapkin')->get();
        $datadua = Setuprenker::orderBy('id','desc')->where('jenis','TE')->get();
        return view('finance/setupRAPK.index',compact('datasatu','datadua'));
    }
   
    public function update(Request $request)
    {
        dd($request->all());
        DB::beginTransaction();
        for ($i = 0; $i < count($request->input('indicator_id')); $i++){
            $data = [
                'rentang_awal' => $request->rentang_awal[$i],
                'rentang_akhir' => $request->rentang_awal[$i],
                'capaian' => $request->capaian[$i],
                'kriteria' => $request->rentang_awal[$i]
            ];
            Setuprenker::where('id', $request->id[$i])
                                ->update($data);
            
        }
    DB::commit();

    return redirect('/finance/setupRAPK')->with('sukses','Data Berhasil Diperbaharui');
    }
}
