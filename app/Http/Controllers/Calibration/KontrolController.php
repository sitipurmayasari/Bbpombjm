<?php

namespace App\Http\Controllers\Calibration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use LogActivity;
use App\Media;
use App\Kontrol;


class KontrolController extends Controller
{
    public function index(Request $request)
    {
        $media = Media::all();
        $data = Kontrol::orderBy('id','desc')
                ->paginate('10');
        return view('calibration/kontrolmikro.index',compact('data','media'));
    }

    public function store(Request $request)
    {
        $data = Kontrol::create($request->all());

        LogActivity::addToLog('Simpan->Setup Kontrol Mikrobiologi, id = '.$data->id);
        return redirect('/calibration/kontrolmikro')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $media = Media::all();
        $data = Kontrol::where('id',$id)->first();
        return view('calibration/kontrolmikro.edit',compact('data','media'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Kontrol::find($id);
        $data->update($request->all());
        LogActivity::addToLog('Ubah->Setup Kontrol Mikrobiologi, id = '.$id);
        return redirect('/calibration/kontrolmikro')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Kontrol::find($id);
        LogActivity::addToLog('Ubah->Hapus Kontrol Mikrobiologi, kontrol : '.$data->status);
        $data->delete();
        return redirect('/calibration/kontrolmikro')->with('sukses','Data Terhapus');
    }

    public function getKontrol(Request $request)
    {
        $id = $request->media_id;

        $data = Kontrol::where('media_id',$id)->get();
        return response()->json([ 'success' => true,'data' => $data],200);
    }

}
