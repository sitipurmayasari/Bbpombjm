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
use App\Bakteri; 
use App\BakteriDetail;

class MikrobaController extends Controller
{
    public function index(Request $request)
    {
        $data = Bakteri::selectRaw('bakteri.*')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('name','LIKE','%'.$request->keyword.'%')
                                ->orWhere('ket', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('calibration/mikroba.index',compact('data'));
    }

    public function create()
    {
        $bakteri = Bakteri::all();
        return view('calibration/mikroba.create',compact('bakteri'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'  => 'required',
            'ket'   => 'required',
        ]); 
        DB::beginTransaction(); 
            $bakteri = Bakteri::create($request->all());
            $bakteri_id = $bakteri->id;
            for ($i = 0; $i < count($request->input('media_id')); $i++){
                $data = [
                    'bakteri_id' => $bakteri_id,
                    'media_id'   => $request->media_id[$i],
                ];
                BakteriDetail::create($data);
            }

        DB::commit();

        LogActivity::addToLog('Simpan->Daftar Bakteri, nama bakteri = '.$request->name);
        return redirect('/calibration/mikroba')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $data = Bakteri::where('id',$id)->first();
        $detail = BakteriDetail::where('bakteri_id',$id)->get();
        $media = Media::all();
        return view('calibration/mikroba.edit',compact('data','detail','media'));
    }


    public function update(Request $request, $id)
    {
        $data = Bakteri::find($id);
        $data->touch();
        LogActivity::addToLog('Ubah->Daftar Bakteri, nama bakteri = '.$data->name);

        DB::beginTransaction(); 
          $data = Bakteri::find($id);
          $data->update($request->all());

        for ($i = 0; $i < count($request->input('media_id')); $i++){
        
          $data = [
            'bakteri_id' => $id,
            'media_id'   => $request->media_id[$i]
          ];
          BakteriDetail::updateOrCreate([
            'id'   => $request->detail_id[$i],
          ],$data);
        }  

      DB::commit();
        return redirect('/calibration/mikroba')->with('sukses','Data Diperbaharui');
    }

    public function deletemed($id)
    {
        $data = BakteriDetail::find($id);
        $out = $data->bakteri_id;

        $data->delete();

        return redirect('calibration/mikroba/edit/'.$out)->with('sukses','Media Terhapus');
    }

   
    public function delete($id)
    {
        $data = Bakteri::find($id);
        $detail = BakteriDetail::where ('bakteri_id',$id)->delete();
        LogActivity::addToLog('Ubah->Hapus Kontrol Mikrobiologi, kontrol : '.$data->status);
        $data->delete();
        return redirect('/calibration/mikroba')->with('sukses','Data Terhapus');
    }
    
}
