<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use PDF;
use DateTime;
use Carbon\Carbon;
use App\Stbook;
use App\Stbook_sppd;
use App\Divisi;

class STBookController extends Controller
{
    public function index(Request $request)
    {
        $data = Stbook::orderBy('stbook.id','desc')
                        ->SelectRaw('stbook.*, divisi.nama')
                        ->leftjoin('divisi','divisi.id','=','stbook.divisi_id')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('stbook_number','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('nama', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('finance/stbook.index',compact('data'));
    }

    public function create()
    {
      $klas = DB::select('SELECT * FROM(
                            SELECT alias, names FROM mailgroup
                            UNION ALL
                            SELECT alias, names FROM mailsubgroup
                            UNION ALL
                            SELECT alias, names FROM mailclasification
                          ) c
                        ORDER BY alias asc');

      $div = Divisi::all();
      return view('finance/stbook.create',compact('div','klas'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
          'stbook_number' => 'required|unique:stbook',
          'divisi_id' => 'required',
          'stbook_date'=> 'required'
      ]);          
      DB::beginTransaction(); 
          $stbook = Stbook::create($request->all());
          $stbook_id = $stbook->id;
          for ($i = 0; $i < count($request->input('nomor_sppd')); $i++){
              $data = [
                  'stbook_id' => $stbook_id,
                  'nomor_sppd'=> $request->nomor_sppd[$i]
              ];
              Stbook_sppd::create($data);
          }
      DB::commit();

      return redirect('/finance/stbook')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
      $div = Divisi::all();
        $data = Stbook::where('id',$id)->first();
        $sppd = Stbook_sppd::where('stbook_id',$id)->get();
        $jum = Stbook_sppd::SelectRaw('COUNT(nomor_sppd) AS jumlah')->where('stbook_id',$id)->first();
        return view('finance/stbook.edit',compact('data','sppd','jum','div'));
    }

   
    public function update(Request $request, $id)
    {
      $data = Stbook::find($id);
      $data->update($request->all());

      $isi = Stbook_sppd::where('stbook_id',$id);
      $isi->delete();

      DB::beginTransaction(); 
        for ($i = 0; $i < count($request->input('nomor_sppd')); $i++){
            $data = [
                'stbook_id' => $id,
                'nomor_sppd'=> $request->nomor_sppd[$i]
            ];
            Stbook_sppd::create($data);
        }
      DB::commit();

      return redirect('/finance/stbook')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Stbook::find($id);
        $data->delete();

        $isi = Stbook_sppd::where('stbook_id',$id);
        $isi->delete();
        return redirect('/finance/stbook')->with('sukses','Data Terhapus');
    }

    function getnosppd(Request $request){

      $baris = $request->last_baris;
      $sppd = Stbook_sppd::orderBy('id','desc')->whereYear('created_at',date('Y'))->get(); 
      $bidang = Divisi::select('kode_sppd')->where('id',$request->divisi_id)->first();
      $counting = Stbook_sppd::SelectRaw("COUNT(*)AS jum ")->first();
      $first = "0001";
      if($sppd->count()>0){
        $first = $counting->jum+$baris;
          // $first = $counting->jum+1;
          if($first < 10){
            $first = "000".$first;
          }else if($first < 100){
            $first = "00".$first;
          }else if($first < 1000){
          $first = "0".$first;
          }
      }
          $no_sppd = $first."/".$bidang->kode_sppd."/SPPD/BBPOM"."/".date('Y');
      
      return response()->json([ 
          'success' => true,
          'no_sppd' => $no_sppd],200
      );
  }

  function getnosppdnext(Request $request){

      $baris = $request->plusplus;
      $sppd = Stbook_sppd::orderBy('id','desc')->whereYear('created_at',date('Y'))->get(); 
      $bidang = Divisi::select('kode_sppd')->where('id',$request->divisi_id)->first();
      $counting = Stbook_sppd::SelectRaw("COUNT(*)AS jum")->first();
      $first = "0001";
      if($sppd->count()>0){
        // $first = $sppd->first()->id+$baris;
        $first = $counting->jum+$baris;
          if($first < 10){
            $first = "000".$first;
          }else if($first < 100){
            $first = "00".$first;
          }else if($first < 1000){
          $first = "0".$first;
          }
      }
          $no_sppd = $first."/".$bidang->kode_sppd."/SPPD/BBPOM"."/".date('Y');
      
      return response()->json([ 
          'success' => true,
          'no_sppd' => $no_sppd],200
      );
  }

    function getnost(Request $request){

        $bidang = Divisi::select('lokasi')->where('id',$request->divisi_id)->first();
        $klasifikasi = $request->klasifikasi;
        $dates = $request->date;
        $panda = $request->stpanda;
      
        $no_st = $klasifikasi.".".$bidang->lokasi.".".date('m').".".date('y').".".$panda;
        
        return response()->json([ 
            'success' => true,
            'no_st' => $no_st],200
        );
    }

   


}
