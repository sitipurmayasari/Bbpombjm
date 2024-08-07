<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Eselontwo;
use App\Eselontwo_detail;
use App\Renta;
use App\Renta_det;
use App\Target;
use App\Indicator;
use App\User;
use App\RealRAPK;
use App\Realrapk_detail;
use App\Pagu;
use Excel;
use PDF;
use DateTime;
use LogActivity;


class RealRAPKController extends Controller
{
    public function index(Request $request)
    {
         $data = Renta::orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('dates','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('filename', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('year', 'LIKE','%'.$request->keyword.'%');
                        })
                ->paginate('10');
        //-------------------lama------------------------------------------
        // $data = RealRAPK::orderBy('id','desc')
        //                 ->when($request->keyword, function ($query) use ($request) {
        //                     $query->where('dates','LIKE','%'.$request->keyword.'%')
        //                             ->orWhere('filename', 'LIKE','%'.$request->keyword.'%')
        //                             ->orWhere('year', 'LIKE','%'.$request->keyword.'%');
        //                     })
        // ->paginate('10');
        return view('finance/realRAPK.index',compact('data'));
    }

    public function create()
    {
        $pagu = Pagu::all();
        $rapk = Eselontwo::all();
        $user = User::where('aktif','=','Y')->whereRaw('jabatan_id IN ("6","7","11")')->get();
        $kapom = User::where('aktif','=','N')->where('jabatan_id','=','1')->get();

        return view('finance/realRAPK.create',compact('user','kapom','rapk','pagu'));
    }

    public function generate(Request $request)
    {
        $data = RealRAPK::create($request->all());
        $rens = $data->id;

        return redirect('/finance/realRAPK/entrydata/'.$rens);
    }

    public function entrydata($id)
    {
        $data = RealRAPK::where('id',$id)->first();
        $indi = Indicator::all();
        return view('finance/realRAPK/entrydata',compact('indi','data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
            for ($i = 0; $i < count($request->input('indicator_id')); $i++){
                $data = [
                    'indicator_id'  => $request->indicator_id[$i],
                    'realisasi'     => $request->realisasi[$i],
                    'hasil'         => $request->hasil[$i],
                    'hasiltahun'    => $request->hasiltahun[$i],
                    'nps'           => $request->nps[$i]
                ];
                Realrapk_detail::create($data);
            }
        DB::commit(); 
        return redirect('/finance/realRAPK')->with('sukses','Data Tersimpan');
    }
   

    public function editmeta($id)
    {
        $pagu = Pagu::all();
        $rapk = Eselontwo::all();
        $data = RealRAPK::where('id',$id)->first();
        $user = User::where('aktif','=','Y')->whereRaw('jabatan_id IN ("6","7","11")')->get();
        $kapom = User::where('aktif','=','Y')->where('jabatan_id','=','1')->get();
        return view('finance/realRAPK/editmeta',compact('data','user','kapom','rapk','pagu'));
    }


    public function updatemeta(Request $request, $id)
    {
        $data = RealRAPK::find($id);
        $data->update($request->all());
        return redirect('/finance/realRAPK')->with('sukses','Data Diperbaharui');
    }


    public function edit($id)
    {
        $data = RealRAPK::where('id',$id)->first();
        $indi = Indicator::all();
        $rapk = Realrapk_detail::where('realRAPK_id',$id)
                                    ->get();
        return view('finance/realRAPK/edit',compact('indi','data','rapk'));
    }

   
    public function update(Request $request, $id)
    {
        //-----lama--------
        // DB::beginTransaction();
        // for ($i = 0; $i < count($request->input('indicator_id')); $i++){
        //     $data = [
        //         'indicator_id'  => $request->indicator_id[$i],
        //         'realisasi'     => $request->realisasi[$i],
        //         'hasil'         => $request->hasil[$i],
        //         'hasiltahun'    => $request->hasiltahun[$i],
        //         'nps'           => $request->nps[$i]
        //     ];
        //     Realrapk_detail::where('id', $request->id[$i])
        //                         ->update($data);
            
        // }
        // DB::commit();
        $data = Renta::find($id);
        $data->touch();

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

    return redirect('/finance/realRAPK')->with('sukses','Data Telah Diverifikasi');
    }

    public function editnew($id)
    {
        $data = Renta::where('id',$id)->first();
        $detail = Renta_det::where('renta_id',$id)->get();
        return view('finance/realRAPK/editnew',compact('data','detail'));
    }

}
