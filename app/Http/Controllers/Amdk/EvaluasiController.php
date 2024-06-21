<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Pelatihan;
use App\Evaluasi;
use App\Evaluasi_detail;
use App\Aspek_evaluasi;
use LogActivity;



class EvaluasiController extends Controller
{
    public function index(Request $request)
    {
        $peg =auth()->user()->id;
        $data = Pelatihan::orderBy('dari','desc')
                        ->select('pelatihan.*')
                        ->leftjoin('jenis_pelatihan','jenis_pelatihan.id','pelatihan.jenis_pelatihan_id')
                        ->where('pelatihan.evaluator_id','=',$peg)
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('nama','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('dari', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('sampai', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('lama', 'LIKE','%'.$request->keyword.'%');
                            })
                        ->paginate('10');
        return view('amdk/evaluasi.index',compact('data'));
    }

    public function proses($id)
    {
        $data = Pelatihan::where('id', $id)
                            ->first();
        $aspek = Aspek_evaluasi::all();
        return view('amdk/evaluasi.create',compact('data','aspek'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'coment'=> 'required'
        ]);
        // dd($request->all());
        $pelatihan = Pelatihan::find($request->pelatihan_id);
        if($pelatihan) {
            $pelatihan->evaluasi = 'Y';
            $pelatihan->save();
        }

        DB::beginTransaction();
            $evaluasi =Evaluasi::create($request->all());
            $evaluasi_id = $evaluasi->id;
            for ($i = 0; $i < count($request->input('aspek_evaluasi')); $i++){
                // dd($request->point[$i][$i+1]);
                $data = [
                    'evaluasi_id' => $evaluasi_id,
                    'aspek_evaluasi' => $request->aspek_evaluasi[$i],
                    'point' => $request->point[$i][$i+1]
                ];
                Evaluasi_detail::create($data);

            }

            // LogActivity::addToLog('Simpan->penilaian evaluasi pelatihan = '.$request->pelatihan_id);
        DB::commit(); 
        return redirect('/amdk/evaluasi')->with('sukses','Data Tersimpan');
    }
}
