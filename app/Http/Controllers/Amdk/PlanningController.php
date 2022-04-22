<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Setup_ak;
use App\Pejabat;
use App\Jabasn;
use App\Skp;
use App\Skp_detail;
use App\Perencanaan;
use App\Perencanaan_det;
use PDF;
use DateTime;
use Carbon\Carbon;

class PlanningController extends Controller
{

    public function index(Request $request)
    {
        $data = Perencanaan::OrderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('plan_date','LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('amdk/planning.index',compact('data'));
    }

    public function create()
    {
        $users_id = auth()->user()->id; 
        $peg = auth()->user()->jabasn_id;

        $skp = Skp::where('users_id',$users_id)->get();
        $jab = Jabasn::where('id',$peg)->first();

        $ak = Setup_ak::OrderBy('kode_ak','asc')
                        ->whereRaw('pelaksana IN ("Semua Jenjang","'.$jab->jabatan.'")')->get();

        $tahu = Pejabat::selectraw('DISTINCT(jabatan_id), id, divisi_id, subdivisi_id, users_id, pjs')
                                -> whereraw('pjs is null and jabatan_id != 6 and subdivisi_id is null')->Orderby('id','desc')->get();
        return view('amdk/planning.create',compact('skp','tahu','jab','ak'));
    }

    public function store(Request $request)
    { 
     
        $this->validate($request,[
            'plan_date' => 'required',
            'skp_id'    => 'required'
        ]);          
        DB::beginTransaction(); 
            $ren = Perencanaan::create($request->all());
            $perencanaan_id = $ren->id;
          for ($i = 0; $i < count($request->input('setup_ak_id')); $i++){
              $data = [
                  'perencanaan_id'  => $perencanaan_id,
                  'kin_date'        => $request->kin_date[$i],
                  'skp_detail_id'   => $request->skp_detail_id[$i],
                  'setup_ak_id'     => $request->setup_ak_id[$i],
                  'nilai_ak'        =>$request->nilai_ak[$i]
              ];
              Perencanaan_det::create($data);
          }

          DB::commit();

        return redirect('/amdk/planning');  
    }

    public function edit($id)
    {
        $data = Perencanaan::where('id',$id)->first();

        $skp = Skp::where('users_id',$data->skp->users_id)->get();
        $jab = Jabasn::where('id',$data->skp->jabasn_id)->first();
        $skp_det = Skp_detail::where('skp_id',$data->skp_id)->get();

        $ak = Setup_ak::OrderBy('kode_ak','asc')
                        ->whereRaw('pelaksana IN ("Semua Jenjang","'.$jab->jabatan.'")')->get();

        $tahu = Pejabat::selectraw('DISTINCT(jabatan_id), id, divisi_id, subdivisi_id, users_id, pjs')
                                -> whereraw('pjs is null and jabatan_id != 6 and subdivisi_id is null')->Orderby('id','desc')->get();
        $detail = Perencanaan_det::where('perencanaan_id',$id)->get();
        return view('amdk/planning.edit',compact('data','detail','skp','tahu','jab','ak','skp_det'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
      $perencanaan = Perencanaan::find($id);
      $perencanaan->update($request->all());

      DB::beginTransaction(); 
        //---------------detail----------------------
        for ($i = 0; $i < count($request->input('setup_ak_id')); $i++){
            $data = [
                'perencanaan_id'  => $id,
                'kin_date'        => $request->kin_date[$i],
                'skp_detail_id'   => $request->skp_detail_id[$i],
                'setup_ak_id'     => $request->setup_ak_id[$i],
                'nilai_ak'        =>$request->nilai_ak[$i]
            ];
            Skp_detail::updateOrCreate([
              'id'   => $request->detail_id[$i],
            ],$data);
        }
        DB::commit(); 

      return redirect('/amdk/planning')->with('sukses','Data Diperbaharui');
    }

    
    public function delete($id)
    {
        $data = Perencanaan::find($id);
        $data->delete();
        $detail = Perencanaan_det::where('skp_id',$id)->get();
        $detail->delete();
        return redirect('/amdk/planning')->with('sukses','Data Terhapus');
    }

    public function deletedet($id)
    {
        $data = Perencanaan_det::find($id);
        $out = $data->perencanaan_id;
        $data->delete();
        return redirect('amdk/planning/edit/'.$out)->with('sukses','data Terhapus');
    }

    public function print($id)
    {
      $data = Perencanaan::where('id',$id)->first();
      $isian = Perencanaan_det::orderBy('id','asc')
                          ->where('perencanaan_id','=',$id)
                          ->get();
      $hit = Perencanaan_det::SelectRaw("SUM(nilai_ak) AS nilai_ak")
                      ->where('perencanaan_id','=',$id)->first();
      $pdf = PDF::loadview('amdk/planning.print',compact('data','isian','hit'));
      return $pdf->stream();
    }


}
