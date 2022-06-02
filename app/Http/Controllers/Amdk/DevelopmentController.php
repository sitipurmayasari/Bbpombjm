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
use App\Development;
use App\Development_det;
use PDF;
use DateTime;
use Carbon\Carbon;

class DevelopmentController extends Controller
{

    public function index(Request $request)
    {
        $data = Development::OrderBy('id','desc')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('plan_date','LIKE','%'.$request->keyword.'%');
                            })
                            ->paginate('10');
        return view('amdk/development.index',compact('data'));
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
        return view('amdk/development.create',compact('skp','tahu','jab','ak'));
    }

    public function store(Request $request)
    { 
     
        $this->validate($request,[
            'plan_date' => 'required',
            'skp_id'    => 'required'
        ]);          
        DB::beginTransaction(); 
            $ren = Development::create($request->all());
            $development_id = $ren->id;
          for ($i = 0; $i < count($request->input('setup_ak_id')); $i++){
              $data = [
                  'development_id'  => $development_id,
                  'kin_date'        => $request->kin_date[$i],
                  'setup_ak_id'     => $request->setup_ak_id[$i],
                  'ak'              => $request->ak[$i],
                  'bukti'           =>$request->bukti[$i],
                  'volume'           =>$request->volume[$i]
              ];
              Development_det::create($data);
          }

          DB::commit();

        return redirect('/amdk/development');  
    }

    public function edit($id)
    {
        $data = Development::where('id',$id)->first();

        $skp = Skp::where('users_id',$data->skp->users_id)->get();
        $jab = Jabasn::where('id',$data->skp->jabasn_id)->first();
        $ak = Setup_ak::OrderBy('kode_ak','asc')
                        ->whereRaw('pelaksana IN ("Semua Jenjang","'.$jab->jabatan.'")')->get();

        $tahu = Pejabat::selectraw('DISTINCT(jabatan_id), id, divisi_id, subdivisi_id, users_id, pjs')
                                -> whereraw('pjs is null and jabatan_id != 6 and subdivisi_id is null')->Orderby('id','desc')->get();
        $detail = Development_det::where('development_id',$id)->get();
        return view('amdk/development.edit',compact('data','detail','skp','tahu','jab','ak'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
      $kembang = Development::find($id);
      $kembang->update($request->all());

      DB::beginTransaction(); 
        //---------------detail----------------------
        for ($i = 0; $i < count($request->input('setup_ak_id')); $i++){
            $data = [
                'development_id'  => $id,
                'kin_date'        => $request->kin_date[$i],
                'setup_ak_id'     => $request->setup_ak_id[$i],
                'ak'              => $request->ak[$i],
                'bukti'           =>$request->bukti[$i],
                'volume'           =>$request->volume[$i]
            ];
            Development_det::updateOrCreate([
              'id'   => $request->detail_id[$i],
            ],$data);
        }
        DB::commit(); 

      return redirect('/amdk/development')->with('sukses','Data Diperbaharui');
    }

    
    public function delete($id)
    {
        $detail = Development_det::where('development_id',$id );
        $detail->delete();
        $data = Development::find($id);
        $data->delete();
        return redirect('/amdk/development')->with('sukses','Data Terhapus');
    }

    public function deletedet($id)
    {
        $data = Development_det::find($id);
        $out = $data->development_id;
        $data->delete();
        return redirect('amdk/development/edit/'.$out)->with('sukses','data Terhapus');
    }

    public function print($id)
    {
      $data = Development::where('id',$id)->first();
      $isian = Development_det::orderBy('id','asc')
                          ->where('development_id','=',$id)
                          ->get();
      $pdf = PDF::loadview('amdk/development.print2',compact('data','isian'));
      return $pdf->stream();
    }


}
