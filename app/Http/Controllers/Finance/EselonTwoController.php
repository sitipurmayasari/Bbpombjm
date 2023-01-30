<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Eselontwo;
use App\Eselontwo_detail;
use App\Target;
use App\Indicator;
use App\Renstrakal;
use App\Renstrakal_detail;
use App\User;
use Excel;
use PDF;
use DateTime;
use LogActivity;

class EselonTwoController extends Controller
{
    public function index(Request $request)
    {
        $data = Eselontwo::orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('dates','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('year', 'LIKE','%'.$request->keyword.'%');
                            })
        ->paginate('10');
        return view('finance/eselontwo.index',compact('data'));
    }

    public function create()
    {
        $renstra = Renstrakal::all();
        $user = User::where('aktif','=','Y')->whereRaw('jabatan_id IN ("6","7","11")')->get();
        $kapom = User::where('jabatan_id','=','1')->get();
        return view('finance/eselontwo.create',compact('renstra','user','kapom'));
    }

    public function generate(Request $request)
    {
        $data = Eselontwo::create($request->all());
        $rens = $data->id;
        LogActivity::addToLog('Simpan->PK Eselon II, id = '.$rens);
        return redirect('/finance/eselontwo/entrydata/'.$rens);
    }

    public function entrydata($id)
    {
        $data = Eselontwo::where('id',$id)->first();
        $indi = Indicator::all();
        return view('finance/eselontwo/entrydata',compact('indi','data'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
            for ($i = 0; $i < count($request->input('indicator_id')); $i++){
                $data = [
                    'indicator_id'  => $request->indicator_id[$i],
                    'eselontwo_id'  => $request->eselontwo_id[$i],
                    'setahun'  => $request->setahun[$i],
                    'jan'      => $request->jan[$i],
                    'feb'      => $request->feb[$i],
                    'mar'      => $request->mar[$i],
                    'apr'      => $request->apr[$i],
                    'mei'      => $request->mei[$i],
                    'jun'      => $request->jun[$i],
                    'jul'      => $request->jul[$i],
                    'aug'      => $request->aug[$i],
                    'sep'      => $request->sep[$i],
                    'oct'      => $request->oct[$i],
                    'nov'      => $request->nov[$i],
                    'dec'      => $request->dec[$i]
                ];
                Eselontwo_detail::create($data);
            }
        DB::commit(); 
        return redirect('/finance/eselontwo')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Eselontwo::where('id',$id)->first();
        $indi = Indicator::all();
        $ese = Eselontwo_detail::where('eselontwo_id',$id)
                                    ->get();
        return view('finance/eselontwo/edit',compact('indi','data','ese'));
    }

   
    public function update(Request $request, $id)
    {
        LogActivity::addToLog('Update->PK Eselon II, id = '.$id);

        DB::beginTransaction();
        for ($i = 0; $i < count($request->input('indicator_id')); $i++){
            $data = [
                'indicator_id' => $request->indicator_id[$i],
                'setahun'      => $request->setahun[$i],
                    'jan'      => $request->jan[$i],
                    'feb'      => $request->feb[$i],
                    'mar'      => $request->mar[$i],
                    'apr'      => $request->apr[$i],
                    'mei'      => $request->mei[$i],
                    'jun'      => $request->jun[$i],
                    'jul'      => $request->jul[$i],
                    'aug'      => $request->aug[$i],
                    'sep'      => $request->sep[$i],
                    'oct'      => $request->oct[$i],
                    'nov'      => $request->nov[$i],
                    'dec'      => $request->dec[$i]
            ];
            Eselontwo_detail::where('id', $request->id[$i])
                            ->update($data);
        }
    DB::commit();

    return redirect('/finance/eselontwo')->with('sukses','Data Berhasil Diperbaharui');
    }

    public function editmeta($id)
    {
        $data = Eselontwo::where('id',$id)->first();
        $renstra = Renstrakal::all();
        $user = User::where('aktif','=','Y')->whereRaw('jabatan_id IN ("6","7","11")')->get();
        $kapom = User::where('jabatan_id','=','1')->get();
        return view('finance/eselontwo/editmeta',compact('data','renstra','user','kapom'));
    }


    public function updatemeta(Request $request, $id)
    {
        LogActivity::addToLog('Update->PK Eselon II, id = '.$id);
        
        $data = Eselontwo::find($id);
        $data->update($request->all());
        return redirect('/finance/eselontwo')->with('sukses','Data Diperbaharui');
    }


    public function agree($id)
    {
        $data = Eselontwo::where('id',$id)->first();
        $renstra = Renstrakal::where('id',$data->renstrakal_id)->first();
        $isi = Renstrakal_detail::where('renstrakal_id',$data->renstrakal_id)
                                ->where('years',$data->years)
                                ->get();
        $pdf = PDF::loadview('finance/eselontwo/agree',compact('data','renstra','isi'));
      
        return $pdf->stream();
    }

    public function detail($id)
    {
        $data = Eselontwo::where('id',$id)->first();
        $indi = Indicator::all();
        $renstra = Renstrakal::where('id',$data->renstrakal_id)->first();
        $ese = Eselontwo_detail::SelectRaw('eselontwo_detail.*, persentages')
                                    ->where('eselontwo_id',$id)
                                    ->leftJoin('renstrakal_detail','renstrakal_detail.indicator_id','=','eselontwo_detail.indicator_id')
                                    ->where('years',$data->years)
                                    ->get();
        $pdf = PDF::loadview('finance/eselontwo/detail',compact('indi','data','ese','renstra'));
      
        return $pdf->stream();
    }

}
