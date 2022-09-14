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
use App\User;
use App\Monitor;
use App\MonitorDetail;
use PDF;

class MikrobaController extends Controller
{
    public function index(Request $request)
    {
        $data = Monitor::selectRaw('monitor.*')
                    ->leftjoin('bakteri','bakteri.id','monitor.bakteri_id')
                    ->leftjoin('users','users.id','monitor.users_id')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('monitor.number','LIKE','%'.$request->keyword.'%')
                                ->orWhere('bakteri.name', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('users.name', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('calibration/mikroba.index',compact('data'));
    }

    public function create()
    {
        $bakteri = Bakteri::all();
        $nomor = $this->getNomor();
        $peg = User::where('subdivisi_id','4')->where('aktif','Y')->get();
        return view('calibration/mikroba.create',compact('bakteri','nomor','peg'));
    }

    function getNomor(){


        $nomor = Monitor::orderBy('id','desc')->whereYear('created_at',date('Y'))->get();
        $first = "001";
        $bulan = monthToRomawi(date('m'));
        if($nomor->count()>0){
          $first = $nomor->first()->id+1;
          if($first < 10){
              $first = "00".$first;
          }else if($first < 100){
              $first = "0".$first;
          }
        }
        $nosbb = $first."/MIK/".$bulan."/".date('Y');
        return $nosbb;
      }

   
    public function store(Request $request)
    {

        DB::beginTransaction(); 
            $monitor = Monitor::create($request->all());
            $monitor_id = $monitor->id;
            for ($i = 0; $i < count($request->input('amati_date')); $i++){
                $data = [
                    'monitor_id' => $monitor_id,
                    'amati_date' => $request->amati_date[$i],
                    'media_id'   => $request->media_id[$i],
                    'kontrol_id' => $request->kontrol_id[$i],
                ];
                MonitorDetail::create($data);
            }

        DB::commit();

        LogActivity::addToLog('Simpan->Monitoring Mikroba, nomor = '.$request->number);
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

    public function delete($id)
    {
        $data = Monitor::find($id);
        $detail = MonitorDetail::where ('bakteri_id',$id)->delete();
        LogActivity::addToLog('Ubah->Hapus monitoring Mikrobiologi, nomor : '.$data->number);
        $data->delete();
        return redirect('/calibration/mikroba')->with('sukses','Data Terhapus');
    }

    public function print($id)
    {
        $data = Monitor::find($id);
        $detail = MonitorDetail::where('monitor_id',$id)->get();

        // return view('calibration/mikroba.cetak',compact('data','detail'));
        $pdf = PDF::loadview('calibration/mikroba.cetak',compact('data','detail'));
        return $pdf->stream();

    }
    
}
