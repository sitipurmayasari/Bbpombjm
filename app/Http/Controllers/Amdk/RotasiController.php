<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Rotasi;
use App\Teamleader;
use App\RotasiGrade;
use App\User;
use PDF;
use LogActivity;

class RotasiController extends Controller
{

    public function index(Request $request)
    {
        $peg =auth()->user()->id;
        $data = Rotasi::orderBy('rotasi.id','desc')
                        ->selectraw('rotasi.*, users.name')
                        ->where('evaluator',$peg)
                        ->leftJoin('users','users.id','=','rotasi.users_id')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('users.name','LIKE','%'.$request->keyword.'%');
                            })
                        ->paginate('10');
        return view('amdk/rotasi.index',compact('data'));
    }

    public function assignment(Request $request)
    {
        $data = Rotasi::orderBy('rotasi.id','desc')
                    ->selectraw('rotasi.*, users.name')
                    ->leftJoin('users','users.id','=','rotasi.users_id')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('users.name','LIKE','%'.$request->keyword.'%');
                        })
                    ->paginate('10');
        return view('amdk/rotasi.assignment',compact('data'));
    }

    public function create()
    {
        $katim = Teamleader::all();
        $user = User::where('aktif','Y')->where('jabasn_id','!=','null')->get();
        return view('amdk/rotasi.create',compact('katim','user'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'tanggal' => 'placementDate|date',
            'users_id'=> 'required',
            'old'=> 'required',
            'new'=> 'required',
            'evaluator'=> 'required',
        ]);

        DB::beginTransaction();
            $rotasi =Rotasi::create($request->all());
            $rotasi_id = $rotasi->id;
            for ($i = 0; $i < count($request->input('statement')); $i++){
                $data = [
                    'rotasi_id' => $rotasi_id,
                    'statement' => $request->statement[$i]
                ];
                RotasiGrade::create($data);

            }
            LogActivity::addToLog('Simpan->Evaluasi Rotasi/Mutasi->Data Pegawai->'.$request->users_id); 
        DB::commit(); 

        return redirect('/amdk/rotasi/assignment')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {

        $katim = Teamleader::all();
        $user = User::where('aktif','Y')->where('jabasn_id','!=','null')->get();
        $data = Rotasi::where('id',$id)->first();
        $detail = RotasiGrade::where('rotasi_id',$id)->get();
        $hit    = RotasiGrade::SelectRaw('COUNT(id) AS jum')->where('rotasi_id',$id)->first();
        return view('amdk/rotasi/edit',compact('data','detail','katim','user','hit'));
    }
   
    public function evaluation($id)
    {
        $now = Carbon::now();
        $data = Rotasi::where('id',$id)->first();
        $detail = RotasiGrade::where('rotasi_id',$id)->get();
        return view('amdk/rotasi/evaluation',compact('data','detail','now'));
    }

   
    public function update(Request $request, $id)
    {
        $rotasi = Rotasi::find($id);
        $rotasi->touch();
        $rotasi->update($request->all());
        DB::beginTransaction();
           for ($i = 0; $i < count($request->input('statement')); $i++){
            $data = [
                'rotasi_id' => $id,
                'statement' => $request->statement[$i],
                'values'    => $request->values[$i]
            ];
            RotasiGrade::updateOrCreate([
              'id'   => $request->nilai_id[$i],
            ],$data);
      }
        DB::commit(); 

        LogActivity::addToLog('Ubah->Evaluasi Rotasi/Mutasi->id'.$rotasi->id);
        return redirect('/amdk/rotasi')->with('sukses','Data Diperbaharui');
    }

    public function delete($id)
    {
        $data = Rotasi::find($id);
        LogActivity::addToLog('Hapus->Evaluasi Rotasi/Mutasi->id'.$data->id);
        $data->delete();
        return redirect('/amdk/rotasi.assignment')->with('sukses','Data Terhapus');

    }

    public function cetak($id)
    {
        $data   = Rotasi::where('id',$id)->first();
        $detail = RotasiGrade::where('rotasi_id',$id)->get();
        $result = RotasiGrade::SelectRaw("Round(AVG(`values`)) AS avg")->where('rotasi_id',$id)->first();
        $pdf = PDF::loadview('amdk/rotasi.cetak',compact('data','detail','result'));
        return $pdf->stream();
    }

}

