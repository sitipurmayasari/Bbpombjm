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
use App\Support;
use App\Support_det;
use PDF;
use DateTime;
use Carbon\Carbon;

class SupportController extends Controller
{

    public function index(Request $request)
    {
        $data = Support::OrderBy('id','desc')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('plan_date','LIKE','%'.$request->keyword.'%');
                            })
                            ->paginate('10');
        return view('amdk/support.index',compact('data'));
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
        return view('amdk/support.create',compact('skp','tahu','jab','ak'));
    }

    public function store(Request $request)
    { 
     
        $this->validate($request,[
            'plan_date' => 'required',
            'skp_id'    => 'required'
        ]);          
        DB::beginTransaction(); 
            $ren = Support::create($request->all());
            $support_id = $ren->id;
          for ($i = 0; $i < count($request->input('setup_ak_id')); $i++){
              $data = [
                  'support_id'      => $support_id,
                  'kin_date'        => $request->kin_date[$i],
                  'setup_ak_id'     => $request->setup_ak_id[$i],
                  'ak'              => $request->ak[$i],
                  'bukti'           =>$request->bukti[$i],
                  'volume'           =>$request->volume[$i]
              ];
              Support_det::create($data);
          }

          DB::commit();

        return redirect('/amdk/support');  
    }

    public function edit($id)
    {
        $data = Support::where('id',$id)->first();

        $skp = Skp::where('users_id',$data->skp->users_id)->get();
        $jab = Jabasn::where('id',$data->skp->jabasn_id)->first();
        $ak = Setup_ak::OrderBy('kode_ak','asc')
                        ->whereRaw('pelaksana IN ("Semua Jenjang","'.$jab->jabatan.'")')->get();

        $tahu = Pejabat::selectraw('DISTINCT(jabatan_id), id, divisi_id, subdivisi_id, users_id, pjs')
                                -> whereraw('pjs is null and jabatan_id != 6 and subdivisi_id is null')->Orderby('id','desc')->get();
        $detail = Support_det::where('support_id',$id)->get();
        return view('amdk/support.edit',compact('data','detail','skp','tahu','jab','ak'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
      $kembang = Support::find($id);
      $kembang->update($request->all());

      DB::beginTransaction(); 
        //---------------detail----------------------
        for ($i = 0; $i < count($request->input('setup_ak_id')); $i++){
            $data = [
                'support_id'    => $id,
                'kin_date'      => $request->kin_date[$i],
                'setup_ak_id'   => $request->setup_ak_id[$i],
                'ak'            => $request->ak[$i],
                'bukti'         =>$request->bukti[$i],
                'volume'        =>$request->volume[$i]
            ];
            Support_det::updateOrCreate([
              'id'   => $request->detail_id[$i],
            ],$data);
      }
        DB::commit(); 

      return redirect('/amdk/support')->with('sukses','Data Diperbaharui');
    }

    
    public function delete($id)
    {
        $detail = Support_det::where('support_id',$id);
        $detail->delete();
        $data = Support::find($id);
        $data->delete();
        return redirect('/amdk/support')->with('sukses','Data Terhapus');
    }

    public function deletedet($id)
    {
        $data = Support_det::find($id);
        $out = $data->support_id;
        $data->delete();
        return redirect('amdk/support/edit/'.$out)->with('sukses','data Terhapus');
    }

    public function print($id)
    {
      $data = Support::where('id',$id)->first();
      $isian = Support_det::orderBy('id','asc')
                          ->where('support_id','=',$id)
                          ->get();
      $pdf = PDF::loadview('amdk/support.print2',compact('data','isian'));
      return $pdf->stream();
    }


}
