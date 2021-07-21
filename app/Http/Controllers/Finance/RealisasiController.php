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
       
        $act = Activitycode::all();
        $kom = Komponencode::all();
        $akun = Accountcode::all();
        $loka = Loka::all();
        return view('finance/realisasi.create',compact('act','kom','sub','akun','loka','no_realisasi'));
    }

    public function getAsal(Request $request)
      {
          $data = Pok::where('year',$request->year)
                    ->get();
          return response()->json([ 
              'success' => true,
              'data' => $data],200
          );
      }

    public function getKomponen(Request $request)
    {
        $data = Pok_detail::SelectRaw('DISTINCT subcode_id, subcode.code AS sub, komponencode.code AS kom, detailcode.code AS ro, krocode.code AS kro')
                    ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                    ->LeftJoin('krocode','krocode.id','=','pok_detail.krocode_id')
                    ->LeftJoin('detailcode','detailcode.id','=','pok_detail.detailcode_id')
                    ->LeftJoin('komponencode','komponencode.id','=','pok_detail.komponencode_id')
                    ->LeftJoin('subcode','subcode.id','=','pok_detail.subcode_id')
                    ->where('pok.id',$request->pok_id)
                    ->where('pok.activitycode_id',$request->activitycode_id)
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

    public function getLokasi(Request $request)
    {
        $data = Pok_detail::SelectRaw('distinct loka.id, loka.nama')
                    ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                    ->LeftJoin('loka','loka.id','=','pok_detail.loka_id')
                    ->where('pok.id',$request->pok_id)
                    ->where('pok_detail.accountcode_id',$request->accountcode_id)
                    ->where('pok_detail.subcode_id',$request->subcode_id)
                    ->get();
        return response()->json([ 
            'success' => true,
            'data' => $data],200
        );
    }

    public function getNilai(Request $request)
    {
        $data = Pok_detail::where('pok_id',$request->pok_id)
                    ->where('accountcode_id',$request->accountcode_id)
                    ->where('subcode_id',$request->subcode_id)
                    ->where('loka_id',$request->loka_id)
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
