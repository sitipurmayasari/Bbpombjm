<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Target;
use App\Indicator;
use App\Pagu;
use App\PaguDetail;
use App\Subcode;
use App\Tagging; 
use Excel;
use App\Imports\PaguImport;


class IkuTaggingController extends Controller
{
    public function index(Request $request)
    {
        $data = Pagu::SelectRaw('pagu.*, DATE(created_at) AS tanggal')
                        ->orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                                $query->where('name','LIKE','%'.$request->keyword.'%');
                        })
                            
                        ->paginate('10');
        return view('finance/ikutagging.index',compact('data'));
    }

    public function create()
    {
        $target = Target::all();
        return view('finance/ikutagging.create',compact('target'));
    }

    public function impor(Request $request)
    {
        $this->validate($request, [
            'diimpor' => 'required|mimes:csv,xls,xlsx',
            'year' => 'required',
            'month' => 'required',
            'users_id'=> 'required'
        ]);

        $file = $request->diimpor;
        $nama_file = $file->getClientOriginalName();
        
        $file->move('excel',$nama_file);

        $nama = "Pagu".$request->month.$request->year;
        $request->merge([ 'name' => $nama]);

        // import data
        DB::beginTransaction();
          $pagu =Pagu::create($request->all());
          $pagu_id = $pagu->id;

          Excel::import(new PaguImport($pagu_id), urlStorage().'/excel/'.$nama_file);
        //   Excel::import(new PaguImport($pagu_id), public_path('/excel/'.$nama_file));
      
        DB::commit();

        return redirect('/finance/ikutagging/taging/'.$pagu_id);
 
    }

    public function taging($id)
    {   

        $iku    = Indicator::all();
        $pagu   = Pagu::SelectRaw('pagu.*, DATE(created_at) AS tanggal')
                        ->where('id',$id)->first();
        $data   = PaguDetail::SelectRaw('DISTINCT subcode_id,SUM(paguakhir) AS pagusub, SUM(realisasi) AS realisasisub')
                            ->Where('pagu_id',$id)
                            ->GroupBy('accountcode_id','subcode_id')
                            ->orderBy('subcode_id','asc')
                            ->get();

        $sub    = Subcode::all();
        return view('finance/ikutagging.taging',compact('pagu','data','iku','sub'));
    }

    function add(Request $request,$pagu_id, $subcode_id){
        $iku    = Indicator::all();
        $pagu   = Pagu::where('id',$pagu_id)->first();
        $data   = PaguDetail::SelectRaw('DISTINCT subcode_id,SUM(paguakhir) AS pagusub, SUM(realisasi) AS realisasisub')
                            ->Where('subcode_id',$subcode_id)
                            ->Where('pagu_id',$pagu_id)
                            ->GroupBy('accountcode_id','subcode_id')
                            ->orderBy('subcode_id','asc')
                            ->first();
        $akhir  = Pagu::where('id','!=',$pagu_id)->OrderBy('id','desc')->first();
        $last   = Tagging::Where('subcode_id',$subcode_id)
                            ->Where('pagu_id',$akhir->id)
                            ->get();
        return view('finance/ikutagging.addtaging',compact('data','iku','pagu','last'));

    }

    function ubah(Request $request,$pagu_id,$subcode_id){
        $iku    = Indicator::all();
        $pagu   = Pagu::where('id',$pagu_id)->first();
        $nilaisub   = Tagging::Where('subcode_id',$subcode_id)
                            ->Where('pagu_id',$pagu_id)
                            ->first();
        $data   = Tagging::Where('subcode_id',$subcode_id)
                        ->Where('pagu_id',$pagu_id)
                        ->get();
        return view('finance/ikutagging.editagging',compact('data','iku','pagu','nilaisub'));

    }

    public function store(Request $request)
    {
        DB::beginTransaction();
            for ($i = 0; $i < count($request->input('indicator_id')); $i++){
                $data = [
                    'pagu_id'      => $request->pagu_id,
                    'subcode_id'   => $request->subcode_id,
                    'pagusub'      => $request->pagusub,
                    'realisasisub' => $request->realisasisub,
                    'indicator_id' => $request->indicator_id[$i],
                    'ikupersen'    => $request->ikupersen[$i],
                    'paguiku'      => $request->paguiku[$i],
                    'realisasiiku' => $request->realisasiiku[$i]
                ];
                Tagging::create($data);
            }
        DB::commit(); 
        return redirect('/finance/ikutagging/taging/'.$request->pagu_id)->with('sukses','Data Tersimpan');
    }
   
    public function update(Request $request,$id)
    {
    //    dd($request->all());
        DB::beginTransaction();
            Tagging::where('pagu_id', $request->pagu_id)
                    ->where('subcode_id', $request->subcode_id)
                    ->where('pagusub', $request->pagusub)
                    ->delete();
            for ($i = 0; $i < count($request->input('indicator_id')); $i++){
                $data = [
                    'pagu_id'      => $request->pagu_id,
                    'subcode_id'   => $request->subcode_id,
                    'pagusub'      => $request->pagusub,
                    'realisasisub' => $request->realisasisub,
                    'indicator_id' => $request->indicator_id[$i],
                    'ikupersen'    => $request->ikupersen[$i],
                    'paguiku'      => $request->paguiku[$i],
                    'realisasiiku' => $request->realisasiiku[$i]
                ];
                    // Tagging::where('pagu_id',$request->pagu_id)
                    //     ->where('id', $request->id[$i])
                    //     ->update($data);
                    Tagging::create($data);
                    // DB::table('tagging')->updateOrInsert([
                    //     'pagu_id'      => $request->pagu_id,
                    //     'subcode_id'   => $request->subcode_id,
                    //     'pagusub'      => $request->pagusub
                    // ], $data);
                
            }
        DB::commit();

        return redirect('/finance/ikutagging/taging/'.$id)->with('sukses','Data Berhasil Diperbaharui');

    }

    public function cetak($id)
    {
        $data   = Tagging::Where('pagu_id',$id)->orderBy('indicator_id','asc')->orderBy('subcode_id','asc')->get();
        $pagu   = Pagu::SelectRaw('pagu.*, DATE(created_at) AS tanggal')->Where('id',$id)->first();
        $totalakhir   = Tagging::SelectRaw('SUM(pagusub) AS totpagusub, SUM(realisasisub) AS totrealsub, 
                                    SUM(paguiku) AS totpagu, SUM(realisasiiku) AS totreal')
                        ->Where('pagu_id',$id)->orderBy('indicator_id','asc')
                        ->first();
        return view('finance/ikutagging.cetak',compact('data','pagu','totalakhir'));
    }

    public function excel($id)
    {
        $data   = Tagging::Where('pagu_id',$id)->orderBy('indicator_id','asc')->orderBy('subcode_id','asc')->get();
        $pagu   = Pagu::SelectRaw('pagu.*, DATE(created_at) AS tanggal')->Where('id',$id)->first();
        $totalakhir   = Tagging::SelectRaw('SUM(pagusub) AS totpagusub, SUM(realisasisub) AS totrealsub, 
                                    SUM(paguiku) AS totpagu, SUM(realisasiiku) AS totreal')
                        ->Where('pagu_id',$id)->orderBy('indicator_id','asc')
                        ->first();
        return view('finance/ikutagging.excel',compact('data','pagu','totalakhir'));
    }


    public function getdatalama(Request $request)
    {
        $data = Tagging::where('subcode_id',$request->subcode_id)
                  ->get();

        return response()->json([ 
            'success' => true,
            'data' => $data],200
        );
    }

}
