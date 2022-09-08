<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventaris;
use App\User;
use App\Satuan;
use App\Pejabat;
use App\Petugas;
use App\Labory;
use App\BrokenBMN; 
use App\BrokenBMN_det;
use App\Divisi;
use PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use LogActivity;

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
        $div = Divisi::where('id','!=','1')->get();
        return view('invent/brokenBMN.create',compact('data','user','div'));
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

            LogActivity::addToLog('Simpan->BMN Rusak, nomor = '.$request->nomor);

            return redirect('/invent/brokenBMN/')->with('sukses','Tersimpan');
    }

    public function print($id)
    {
        $data = BrokenBMN::where('id',$id)->first();
        $detail = BrokenBMN_det::where('brokenbmn_id',$id)->get();
        $petugas = Petugas::where('id','=','8')->first();
        $mengetahui = Pejabat::where('jabatan_id', '=', 11)
                                ->whereRaw("(SELECT st_date FROM outstation WHERE id=$id) BETWEEN dari AND sampai")
                                ->first();
        $pdf = PDF::loadview('invent/brokenBMN.print',compact('data','mengetahui','petugas','detail'));
        return $pdf->stream();
    }

   
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
        LogActivity::addToLog('Simpan->BMN Rusak, nomor = '.$sbb->nomor);
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
        LogActivity::addToLog('Simpan->BMN Rusak, nomor = '.$data->nomor);
        $data->delete();

        return redirect('/invent/brokenBMN')->with('sukses','Data Terhapus');
    }



}
