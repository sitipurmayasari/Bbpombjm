<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use App\User;
use App\Activitycode;
use App\Krocode;
use App\Detailcode;
use App\Komponencode;
use App\Subcode;
use App\Accountcode;
use App\Loka;
use App\Pok;
use App\Pok_detail;
use App\Implementation;
use App\Realisasi;
use App\RealisasiDetail;


class RealisasiController extends Controller
{
    public function index(Request $request)
    {   
        $data = Realisasi::orderBy('realisasi.id','desc')
                            ->SelectRaw('realisasi.*')
                            ->leftJoin('users','users.id','=','realisasi.users_id')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('users.name','LIKE','%'.$request->keyword.'%')
                                        ->orWhere('users.no_pegawai', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('realisasi.nomor', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('realisasi.keterangan', 'LIKE','%'.$request->keyword.'%');
                            })
                            ->paginate('10');
        return view('finance/realisasi.index',compact('data'));
    }

    public function create()
    {
        $thn  = Carbon::now()->year;
        $loka = Loka::all();
        $pok  = Pok_detail::SelectRaw('pok_detail.*')
                ->leftjoin('pok','pok.id','=','pok_detail.pok_id')
                ->where('pok.year','=',$thn)
                ->get();
        return view('finance/realisasi.create',compact('loka','pok'));
    }

    public function getAsal(Request $request)
      {
          $data = Pok::SelectRaw('pok.*, activitycode.lengkap AS act')
                    ->Leftjoin('activitycode','activitycode.id','=','pok.activitycode_id')
                    ->where('year',$request->year)
                    ->get();
          return response()->json([ 
              'success' => true,
              'data' => $data],200
          );
      }

    public function getKomponen(Request $request)
    {
        $data = Pok_detail::SelectRaw('pok_detail.id, activitycode.lengkap AS act, subcode.kodeall AS sub, 
                                        accountcode.code AS akun, loka.nama')
                        ->leftjoin('pok','pok.id','=','pok_detail.pok_id')
                        ->leftjoin('activitycode','activitycode.id','=','pok.activitycode_id')
                        ->leftjoin('subcode','subcode.id','=','pok_detail.subcode_id')
                        ->leftjoin('accountcode','accountcode.id','=','pok_detail.accountcode_id')
                        ->leftjoin('loka','loka.id','=','pok_detail.loka_id')
                        ->where('pok.id','=',$request->pok_id)
                        ->get();
        return response()->json([ 
            'success' => true,
            'data' => $data],200
        );
    }

    public function getAkunId(Request $request)
    {
        $data = Pok_detail::SelectRaw('DISTINCT accountcode.id, accountcode.name, accountcode.code')
                    ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                    ->LeftJoin('accountcode','accountcode.id','=','pok_detail.accountcode_id')
                    ->where('pok.id',$request->pok_id)
                    ->where('pok.activitycode_id',$request->activitycode_id)
                    ->where('pok_detail.subcode_id',$request->subcode_id)
                    ->get();
        return response()->json([ 
            'success' => true,
            'data' => $data],200
        );
    }


    public function getNilai(Request $request)
    {
        $data = Pok_detail::where('id',$request->pok_detail_id)
                    ->first();
        return response()->json([ 
            'success' => true,
            'data' => $data],200
        );
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'number' => 'required|unique:realisasi',
            'keterangan' =>'required'
        ]);

        DB::beginTransaction(); // kegunaan untuk multiple insert (banyak aksi k database)
            $realisasi =Realisasi::create($request->all());
            $realisasi_id = $realisasi->id;
            for ($i = 0; $i < count($request->input('biaya')); $i++){
                $data = [
                    'realisasi_id' => $realisasi_id,
                    'month' => $request->month[$i] ,
                    'week' => $request->week[$i] ,
                    'biaya' => $request->biaya[$i]
                ];
                RealisasiDetail::create($data);
            }
        DB::commit(); 

        return redirect('/finance/realisasi')->with('sukses','Data Tersimpan');

    }

    public function edit($id)
    {
        $act = Activitycode::all();
        $kom = Komponencode::all();
        $akun = Accountcode::all();
        $loka = Loka::all();
        $data = Realisasi::where('realisasi.id',$id)
                        ->SelectRaw('realisasi.*, pok.year, pok_detail.total')
                        ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                        ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                        ->first();
        $detail = RealisasiDetail::where('realisasi_id',$id)->get();
        $total = $data->total;
        $pok_detail_id = $data->pok_detail_id;
        $sub=array(
            'asalpok' => $data->asalpok,
            'activitycode_id'=>$data->activitycode_id,
            'subcode_id'=>$data->subcode_id,
            'accountcode_id'=>$data->accountcode_id,
            'loka_id'=>$data->loka_id
        );

        return view('finance/realisasi.edit',compact('data','detail','act','kom','akun','loka','total','pok_detail_id','sub'));
    }

   
    public function update(Request $request, $id)
    {
       
        DB::beginTransaction(); // kegunaan untuk multiple insert (banyak aksi k database)
            $realisasi =Realisasi::find($id)->update($request->all());
            RealisasiDetail::where('realisasi_id',$id)->delete();
            for ($i = 0; $i < count($request->input('biaya')); $i++){
                $data = [
                    'realisasi_id' => $id,
                    'month' => $request->month[$i] ,
                    'week' => $request->week[$i] ,
                    'biaya' => $request->biaya[$i]
                ];
                RealisasiDetail::create($data);
            }
        DB::commit(); 

        return redirect('/finance/realisasi')->with('sukses','Data Telah diperbaharui');
    }


}
