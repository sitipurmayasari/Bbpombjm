<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Target;
use App\Indicator;
use App\Eselontwo;
use App\Eselontwo_detail;
use App\Divisi;
use App\Renta;
use App\Renta_det;
use Excel;
use PDF;
use DateTime;
use LogActivity;


class RentaController extends Controller
{
    public function index(Request $request)
    {
        $bidang = auth()->user()->divisi_id;
        $div = Divisi::where('id',$bidang)->first();
        $data = Renta::SelectRaw('renta.*')
                        ->orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('filename','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('years', 'LIKE','%'.$request->keyword.'%');
                            })
        ->paginate('10');
        return view('finance/renta.index',compact('data','div'));
    }

    public function create()
    {
        $bidang = auth()->user()->divisi_id;
        $div = Divisi::where('id',$bidang)->first();
        $rens = Eselontwo::all();
        return view('finance/renta.create',compact('rens','div'));
    }

    public function generate(Request $request)
    {
        $data = Renta::create($request->all());
        $rens = $data->id;
        LogActivity::addToLog('Simpan->Target Bulanan, id = '.$data->id);
        return redirect('/finance/renta/entrydata/'.$rens);
    }

    public function entrydata($id)
    {
        $data = Renta::where('id',$id)->first();
        $detail = Eselontwo_detail::SelectRaw('eselontwo_detail.*')
                                    ->where('eselontwo_id', $data->eselontwo_id)
                                    ->leftjoin('indicator','indicator.id','eselontwo_detail.indicator_id')
                                    ->where('indicator.divisi_id',$data->divisi_id)
                                    ->get();
        return view('finance/renta/entrydata',compact('data','detail'));
    }

    public function store(Request $request)
    {
        
        DB::beginTransaction();
            for ($i = 0; $i < count($request->input('eselontwo_detail_id')); $i++){
                $data = [
                    'renta_id'             => $request->renta_id[$i],
                    'eselontwo_detail_id'  => $request->eselontwo_detail_id[$i],
                    'sebulan'              => $request->sebulan[$i],
                    'capaian'              => $request->capaian[$i],
                    'keterangan'            => $request->keterangan[$i]
                ];
                Renta_det::create($data);
            }
        DB::commit(); 
       

        return redirect('/finance/renta')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Renta::where('id',$id)->first();
        $detail = Renta_det::where('renta_id',$id)->get();
        return view('finance/renta/edit',compact('data','detail'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Renta::find($id);
        $data->touch();

        $outstation_id = $id;
        DB::beginTransaction(); 
          //---------------data----------------------
            $data = Renta::find($id);
            $data->update($request->all());
            //---------------detail----------------------
            for ($i = 0; $i < count($request->input('eselontwo_detail_id')); $i++){
                $detail = [
                    'eselontwo_detail_id'  => $request->eselontwo_detail_id[$i],
                    'sebulan'              => $request->sebulan[$i],
                    'capaian'              => $request->capaian[$i],
                    'keterangan'            => $request->keterangan[$i]
                ];
                Renta_det::updateOrCreate([
                'id'   => $request->outemp_id[$i],
                ],$detail);
            }
        DB::commit();
        LogActivity::addToLog('Ubah->Target Bulanan, id = '.$data->id);
    return redirect('/finance/renta')->with('sukses','Data Berhasil Diperbaharui');
    }

    public function delete($id)
    {
        $data = Renta::find($id);
        LogActivity::addToLog('Simpan->Target Bulanan, id = '.$data->id);
        $data->delete();
        DB::table('renta_detail')->where('renta_id', $id)->delete();
        return redirect('/finance/renta')->with('sukses','Data Terhapus');
    }

}
