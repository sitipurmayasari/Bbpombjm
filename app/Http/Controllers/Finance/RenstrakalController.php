<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Target;
use App\Indicator;
use App\Renstranas;
use App\Renstranas_detail;
use App\Renstrakal;
use App\Renstrakal_detail;
use Excel;
use PDF;
use DateTime;
use LogActivity;


class RenstrakalController extends Controller
{
    public function index(Request $request)
    {
        $data = Renstrakal::orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('filename','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('yearfrom', 'LIKE','%'.$request->keyword.'%');
                            })
        ->paginate('10');
        return view('finance/renstrakal.index',compact('data'));
    }

    public function create()
    {
        return view('finance/renstrakal.create');
    }

    public function generate(Request $request)
    {
        $this->validate($request,[
            'yearfrom' => 'required',
            'tanggal' => 'required',
            'filename' => 'required'
        ]);
        $data = Renstrakal::create($request->all());
        $rens = $data->id;
        LogActivity::addToLog('Ubah->Renstra Nasional, id = '.$data->id);
        return redirect('/finance/renstrakal/entrynas/'.$rens);
    }

    public function entrynas($id)
    {
        $data = Renstrakal::where('id',$id)->first();
        $indi = Indicator::all();
        return view('finance/renstrakal/entrynas',compact('indi','data'));
    }

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'persentages[]' => 'required'
        // ]);
        DB::beginTransaction();
            for ($i = 0; $i < count($request->input('indicator_id')); $i++){
                $data = [
                    'indicator_id'  => $request->indicator_id[$i],
                    'years'          => $request->years[$i],
                    'renstrakal_id' => $request->renstrakal_id[$i],
                    'persentages'   => $request->persentages[$i]
                ];
                Renstrakal_detail::create($data);
            }
        DB::commit(); 
        return redirect('/finance/renstrakal')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $indi = Indicator::all();
        $data = Renstrakal::where('id',$id)->first();
        $renstra = Renstrakal_detail::SelectRaw('DISTINCT years')
                                    ->where('renstrakal_id',$id)->get();
        return view('finance/renstrakal/edit',compact('indi','data','renstra'));
    }

   
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        for ($i = 0; $i < count($request->input('indicator_id')); $i++){
            $data = [
                'indicator_id' => $request->indicator_id[$i],
                'persentages' => $request->persentages[$i]
            ];
            Renstrakal_detail::where('id', $request->id[$i])
                                ->update($data);
                // Tagging::create($data);
            
        }
    DB::commit();
    LogActivity::addToLog('Ubah->Renstra Nasional, id = '.$data->id);
    return redirect('/finance/renstrakal')->with('sukses','Data Berhasil Diperbaharui');
    }

    public function editmeta($id)
    {
        $data = Renstrakal::where('id',$id)->first();
        return view('finance/renstrakal/editmeta',compact('data'));
    }

    public function updatemeta(Request $request, $id)
    {
        $data = Renstrakal::find($id);
        $data->update($request->all());
        return redirect('/finance/renstrakal')->with('sukses','Data Diperbaharui');
    }

    public function delete($id)
    {
        $data = Renstrakal::find($id);
        LogActivity::addToLog('hapus->Renstra Nasional, id = '.$data->id);
        $data->delete();
        DB::table('renstrakal_detail')->where('renstrakal_id', $id)->delete();
        return redirect('/finance/renstrakal')->with('sukses','Data Terhapus');
    }

}
