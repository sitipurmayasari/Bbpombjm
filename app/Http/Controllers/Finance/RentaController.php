<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Target;
use App\Indicator;
use App\Renstrakal;
use App\Renstrakal_detail;
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
        $data = Renta::SelectRaw('renta.*')
                        ->orderBy('id','desc')
                        ->leftjoin('renstrakal','renstrakal.id','renta.renstrakal_id')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('filename','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('years', 'LIKE','%'.$request->keyword.'%');
                            })
        ->paginate('10');
        return view('finance/renta.index',compact('data'));
    }

    public function create()
    {
        $rens = Renstrakal::all();
        return view('finance/renta.create',compact('rens'));
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

        $detail = Renstrakal_detail::where('renstrakal_id', $data->renstrakal_id)->where('years',$data->years)->get();
        return view('finance/renta/entrydata',compact('data','detail'));
    }

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'persentages[]' => 'required'
        // ]);
        DB::beginTransaction();
            for ($i = 0; $i < count($request->input('renstrakal_detail_id')); $i++){
                $data = [
                    'renta_id'              => $request->renta_id[$i],
                    'renstrakal_detail_id'  => $request->renstrakal_detail_id[$i],
                    'setahun'               => $request->setahun[$i],
                    'indicator_id'          => $request->indicator_id[$i],
                    'jan'                   => $request->jan[$i],
                    'feb'                   => $request->feb[$i],
                    'mar'                   => $request->mar[$i],
                    'apr'                   => $request->apr[$i],
                    'mei'                   => $request->mei[$i],
                    'jun'                   => $request->jun[$i],
                    'jul'                   => $request->jul[$i],
                    'aug'                   => $request->aug[$i],
                    'sep'                   => $request->sep[$i],
                    'oct'                   => $request->oct[$i],
                    'nov'                   => $request->nov[$i],
                    'dec'                   => $request->dec[$i]
                ];
                Renta_det::create($data);
            }
        DB::commit(); 
       

        return redirect('/finance/renta')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $rens = Renstrakal::all();
        $data = Renta::where('id',$id)->first();
        $target = Renta_det::where('renta_id',$id)->get();
        return view('finance/renta/edit',compact('data','target','rens'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Renta::find($id);
        $data->touch();
        LogActivity::addToLog('Ubah->Surat Tugas, nomor = '.$data->number);

        $outstation_id = $id;
        DB::beginTransaction(); 
          //---------------data----------------------
            $data = Renta::find($id);
            $data->update($request->all());
            //---------------detail----------------------
            for ($i = 0; $i < count($request->input('renstrakal_detail_id')); $i++){
                $detail = [
                    'renta_id'              => $id,
                    'renstrakal_detail_id'  => $request->renstrakal_detail_id[$i],
                    'setahun'               => $request->setahun[$i],
                    'indicator_id'          => $request->indicator_id[$i],
                    'jan'                   => $request->jan[$i],
                    'feb'                   => $request->feb[$i],
                    'mar'                   => $request->mar[$i],
                    'apr'                   => $request->apr[$i],
                    'mei'                   => $request->mei[$i],
                    'jun'                   => $request->jun[$i],
                    'jul'                   => $request->jul[$i],
                    'aug'                   => $request->aug[$i],
                    'sep'                   => $request->sep[$i],
                    'oct'                   => $request->oct[$i],
                    'nov'                   => $request->nov[$i],
                    'dec'                   => $request->dec[$i]
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
