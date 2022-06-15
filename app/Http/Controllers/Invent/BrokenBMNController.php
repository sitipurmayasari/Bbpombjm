<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventaris;
use App\User;
use App\Satuan;
use App\Pejabat;
use App\Labory;
use App\BrokenBMN; 
use App\BrokenBMN_det;
use App\Divisi;
use PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BrokenBMNController extends Controller
{
    public function index(Request $request)
    {   
        $data = BrokenBMN::orderBy('id','desc')
                        ->select('brokenbmn.*','users.name')
                        ->leftJoin('users','users.id','=','brokenbmn.users_id')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('nomor','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('invent/brokenBMN.index',compact('data'));
    }

    public function create()
    {
        $data = Inventaris::orderBy('nama_barang','asc')
                            ->where('kind','R')
                            ->get();
        $user = User::where('id','!=','1')->where('aktif','Y')->get();
        $norusak = $this->getNoRusak();
        $div = Divisi::where('id','!=','1')->get();
        return view('invent/brokenBMN.create',compact('data','user','norusak','div'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'nomor' => 'required|unique:brokenbmn',
            'tanggal' => 'required|date',
            'users_id'=> 'required'
        ]);

        DB::beginTransaction();
            $broken =BrokenBMN::create($request->all());
            $broken_id = $broken->id;
            for ($i = 0; $i < count($request->input('inventaris_id')); $i++){
                $data = [
                    'brokenbmn_id' => $broken_id,
                    'inventaris_id' => $request->inventaris_id[$i],
                    'ket' => $request->ket[$i]
                ];
                BrokenBMN_det::create($data);
            }
            DB::commit(); 
            return redirect('/invent/brokenBMN/')->with('sukses','Tersimpan');
        // return redirect('/invent/brokenBMN/print/'.$sbb_id);
    }

    // public function print($id)
    // {
    //     $data = Broken::where('id',$id)->first();
    //     $tahu = $data->pejabat_id;
    //     $mengetahui = Pejabat::where('id',$tahu)->first();
    //     $pdf = PDF::loadview('invent/brokenBMN.print',compact('data','mengetahui'));
    //     return $pdf->stream();
    // }

    // public function getBarang(Request $request)
    // {
    //     $id = $request->barang_id;

    //     $data = Inventaris::selectRaw('inventaris.id, inventaris.nama_barang, inventaris.satuan_id, satuan.satuan, SUM(entrystock.stock) AS sisa')
    //                     ->leftJoin('satuan', 'inventaris.satuan_id', '=', 'satuan.id')
    //                     ->leftJoin('entrystock','entrystock.inventaris_id','=','inventaris.id')
    //                     ->where('inventaris.id',$id)
    //                     ->first();
    //     return response()->json([ 'success' => true,'data' => $data],200);
    // }
   
    public function edit($id)
    {
        $data = BrokenBMN::where('id',$id)->first();
        $detail = BrokenBMN_det::where('brokenbmn_id',$id)->get();
        $barang = Inventaris::orderBy('nama_barang','asc')
                            ->where('kind','R')
                            ->get();
        $user = User::where('id','!=','1')->where('aktif','Y')->get();
        $div = Divisi::where('id','!=','1')->get();
        return view('invent/brokenBMN.edit',compact('data','detail','barang','user','div'));
    }

   
    public function update(Request $request, $id)
    {

        $sbb = BrokenBMN::find($id);
        $sbb->update($request->all());
        
        DB::beginTransaction();

        //---------------outst_employee----------------------
         for ($i = 0; $i < count($request->input('inventaris_id')); $i++){
              $data = [
                'brokenbmn_id' => $id,
                'inventaris_id' => $request->inventaris_id[$i],
                'ket'           => $request->ket[$i]
              ];
              BrokenBMN_det::updateOrCreate([
                'id'   => $request->outemp_id[$i],
              ],$data);
        }

      DB::commit();

      return redirect('/invent/brokenBMN')->with('sukses','Data Diperbaharui');
    }

    function getNoRusak(){
      $nomor = BrokenBMN::orderBy('id','desc')->whereYear('tanggal',date('Y'))->get();
      $first = "001";
      if($nomor->count()>0){
        $first = $nomor->first()->id+1;
        if($first < 10){
            $first = "00".$first;
        }else if($first < 100){
            $first = "0".$first;
        }
      }
      $norusak = $first."/BA-BMNRUSAK/BBPOM/".date('m')."/".date('Y');
      return $norusak;
    }

    public function deletelist($id)
    {
        $data = BrokenBMN_det::find($id);
        $out = $data->brokenbmn_id;
        $data->delete();

        return redirect('invent/brokenBMN/edit/'.$out)->with('sukses','Pegawai Terhapus');
    }

    public function delete($id)
    {
        $detail = BrokenBMN_det::where('brokenbmn_id',$id);
        $detail->delete();

        $data = BrokenBMN::find($id);
        $data->delete();

        return redirect('/invent/brokenBMN')->with('sukses','Data Terhapus');
    }



}
