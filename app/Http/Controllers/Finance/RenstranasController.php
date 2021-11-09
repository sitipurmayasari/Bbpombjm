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
use Excel;
use PDF;
use DateTime;


class RenstranasController extends Controller
{
    public function index(Request $request)
    {
        $data = Renstranas::orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('filename','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('yearfrom', 'LIKE','%'.$request->keyword.'%');
                            })
        ->paginate('10');
        return view('finance/renstranas.index',compact('data'));
    }

    public function create()
    {
        return view('finance/renstranas.create');
    }

    public function generate(Request $request)
    {
        // $this->validate($request,[
        //     'yearfrom' => 'required',
        //     'tanggal' => 'required',
        //     'users_id'=> 'required'
        // ]);
       $data = Renstranas::create($request->all());
        $rens = $data->id;

        return redirect('/finance/renstranas/entrynas/'.$rens);
    }

    public function entrynas($id)
    {
        $data = Renstranas::where('id',$id)->first();
        $indi = Indicator::all();
        return view('finance/renstranas/entrynas',compact('indi','data'));
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
                    'renstranas_id' => $request->renstranas_id[$i],
                    'persentages'   => $request->persentages[$i]
                ];
                Renstranas_detail::create($data);
            }
        DB::commit(); 
        return redirect('/finance/renstranas')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $indi = Indicator::all();
        $data = Renstranas::where('id',$id)->first();
        $renstra = Renstranas_detail::SelectRaw('DISTINCT years')
                                    ->where('renstranas_id',$id)->get();
        return view('finance/renstranas/edit',compact('indi','data','renstra'));
    }

   
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        for ($i = 0; $i < count($request->input('indicator_id')); $i++){
            $data = [
                'indicator_id' => $request->indicator_id[$i],
                'persentages' => $request->persentages[$i]
            ];
            Renstranas_detail::where('id', $request->id[$i])
                                ->update($data);
                // Tagging::create($data);
            
        }
    DB::commit();

    return redirect('/finance/renstranas')->with('sukses','Data Berhasil Diperbaharui');
    }

    public function editmeta($id)
    {
        $data = Renstranas::where('id',$id)->first();
        return view('finance/renstranas/editmeta',compact('data'));
    }

    public function updatemeta(Request $request, $id)
    {
        $data = Renstranas::find($id);
        $data->update($request->all());
        return redirect('/finance/renstranas')->with('sukses','Data Diperbaharui');
    }


}
