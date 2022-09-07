<?php

namespace App\Http\Controllers\Calibration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use LogActivity;
use App\Media;


class MediaController extends Controller
{
    public function index(Request $request)
    {
        $data = Media::orderBy('id','desc')
                ->paginate('10');
        return view('calibration/mediamikro.index',compact('data'));
    }

    public function store(Request $request)
    {
        $data = Media::create($request->all());

        LogActivity::addToLog('Simpan->Setup Media, id = '.$data->id);
        return redirect('/calibration/mediamikro')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Media::where('id',$id)->first();
        return view('calibration/mediamikro.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Media::find($id);
        $data->update($request->all());
        LogActivity::addToLog('Ubah->Setup Media, id = '.$id);
        return redirect('/calibration/mediamikro')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Media::find($id);

        LogActivity::addToLog('Ubah->Hapus Media, id = '.$data->id);

        $data->delete();

        return redirect('/calibration/mediamikro')->with('sukses','Data Terhapus');
    }
}
