<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Pejabat;
use App\Jabasn;
use App\Skp;
use App\Skp_detail;
use PDF;
use DateTime;
use Carbon\Carbon;

class SkpController extends Controller
{

    public function index(Request $request)
    {
     
        $data = Skp::OrderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('dates','LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('amdk/skp.index',compact('data'));
    }

    public function create()
    {
        $peg = auth()->user()->jabasn_id;
        $jab = Jabasn::where('id',$peg)->first();
        $tahu = Pejabat::selectraw('DISTINCT(jabatan_id), id, divisi_id, subdivisi_id, users_id, pjs')
                                -> whereraw('pjs is null and jabatan_id != 6 and subdivisi_id is null')->Orderby('id','desc')->get();
        return view('amdk/skp.create',compact('tahu','jab'));
    }

    public function store(Request $request)
    { 
      // dd($request->all());
      $this->validate($request,[
          'dates' => 'required',
          'pejabat_id' => 'required'
      ]);          
      DB::beginTransaction(); 
          $skp = Skp::create($request->all());
          $skp_id = $skp->id;
          for ($i = 0; $i < count($request->input('n_ak')); $i++){
              $data = [
                  'skp_id' => $skp_id,
                  'activity' => $request->activity[$i],
                  'n_ak' => $request->n_ak[$i],
                  'tot_ak' => $request->tot_ak[$i],
                  'quan' => $request->quan[$i],
                  'jen' => $request->jen[$i],
                  'kual' => $request->kual[$i],
                  'time' => $request->time[$i],
                  'cost' => $request->cost[$i]
              ];
              Skp_detail::create($data);
          }

          DB::commit();

        return redirect('/amdk/skp');  
    }

    public function edit($id)
    {
        $peg = auth()->user()->jabasn_id;
        $jab = Jabasn::where('id',$peg)->first();
        $tahu = Pejabat::selectraw('DISTINCT(jabatan_id), id, divisi_id, subdivisi_id, users_id, pjs')
                                -> whereraw('pjs is null and jabatan_id != 6 and subdivisi_id is null')->Orderby('id','desc')->get();
        $data = Skp::where('id',$id)->first();
        $detail = Skp_detail::where('skp_id',$id)->get();
        return view('amdk/skp.edit',compact('data','detail','tahu','jab'));
    }

    public function deletedet($id)
    {
        $data = Skp_detail::find($id);

        $out = $data->skp_id;
        $data->delete();
        return redirect('amdk/skp/edit/'.$out)->with('sukses','data Terhapus');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
      $skp = Skp::find($id);
      $skp->update($request->all());

      DB::beginTransaction(); 
        //---------------detail----------------------
        for ($i = 0; $i < count($request->input('n_ak')); $i++){
            $data = [
                'skp_id'        => $id,
                'activity'      => $request->activity[$i],
                'n_ak'          => $request->n_ak[$i],
                'tot_ak'        => $request->tot_ak[$i],
                'quan'          => $request->quan[$i],
                'jen'           => $request->jen[$i],
                'kual'          => $request->kual[$i],
                'time'          => $request->time[$i],
                'cost'          => $request->cost[$i]
            ];
            Skp_detail::updateOrCreate([
              'id'   => $request->detail_id[$i],
            ],$data);
        }
        DB::commit(); 

      return redirect('/amdk/skp')->with('sukses','Data Diperbaharui');
    }

    
    public function delete($id)
    {
        $data = Skp::find($id);
        $data->delete();
        $petugas = Skp_detail::where('skp_id',$id)->get();
        $petugas->delete();
        return redirect('/amdk/skp')->with('sukses','Data Terhapus');
    }

    public function print($id)
      {
        $data = Skp::where('id',$id)->first();
        $isian = Skp_detail::orderBy('id','asc')
                            ->where('skp_id','=',$id)
                            ->get();
        $hit = Skp_detail::SelectRaw("SUM(n_ak) AS n_ak, SUM(tot_ak) AS tot_ak")
                        ->where('skp_id','=',$id)->first();
        $pdf = PDF::loadview('amdk/skp.print',compact('data','isian','hit'));
        return $pdf->stream();

        
      }


    public function getdata(Request $request)
    {
        $id = $request->skp_id;
        $data= Skp_detail::orderBy('id','asc')
                            ->where('skp_id','=',$id)
                            ->get();
        return response()->json([ 'success' => true,'data' => $data],200);
    }

}
