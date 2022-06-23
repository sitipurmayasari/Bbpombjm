<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventaris;
use App\User;
use App\Sbb;
use App\Sbbdetail;
use App\Satuan;
use App\Pejabat;
use App\Petugas;
use App\Subdivisi;
use App\Divisi;
use App\Entrystock;
use App\Jenisbrg;
use PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AtkRequestOkController extends Controller
{

    public function index(Request $request)
    {   
        $data = Sbb::orderBy('id','desc')
                ->select('sbb.*','users.name')
                ->leftJoin('users','users.id','=','sbb.users_id')
                ->where('sbb.jenis','A')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('tanggal','LIKE','%'.$request->keyword.'%')
                            ->orWhere('nomor', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                })
                ->paginate('10');
        return view('invent/atkrequestok.index',compact('data'));
    }

    public function yes($id)
    {
        $data = Sbb::where('id',$id)->first();
        $ajuan = Sbbdetail::where('sbb_id',$id)->get();

        return view('invent/atkrequestok.yes',compact('data','ajuan'));
    }
    
    public function update(Request $request, $id)
    {
        $sbb = Sbb::find($id);
        $sbb->update($request->all());
        
        DB::beginTransaction();
        Sbbdetail::where('sbb_id', $sbb->id)->delete();

        for ($i = 0; $i < count($request->input('inventaris_id')); $i++){
                $data = [
                    'sbb_id' => $id,
                    'inventaris_id' => $request->inventaris_id[$i],
                    'satuan_id' => $request->satuan_id[$i] ,
                    'jumlah' => $request->jumlah[$i] ,
                    'ket' => $request->ket[$i],
                    'status' => $request->status[$i]

                ];
                Sbbdetail::create($data);

                if ($request->status[$i] == 'Y') {
                    $now = Carbon::now();
                    $stok = [
                        'entry_date' => $now,
                        'inventaris_id' => $request->inventaris_id[$i],
                        'stock' => $request->stock[$i],
                        'keluar' => $request->jumlah[$i],
                        'exp_date' => $now];
                    Entrystock::create($stok);
               }
               
            }
        DB::commit(); 

        if ($request->status == 'S') {
            return redirect('/invent/atkrequestok/print/'.$id)->with('sukses','Data Diperbaharui');
        } else {
            return redirect('/invent/atkrequestok/')->with('sukses','Data Diperbaharui');
        }
    }

    public function print($id)
    {
        $data = Sbb::where('id',$id)->first();
        $isi = Sbbdetail::where('sbb_id',$id)->get();
        $petugas = Petugas::where('id', '=', 4)->first();

        $mengetahui = Pejabat::where('jabatan_id', '=', 11)
                    ->where('divisi_id', '=', 2)
                    ->whereRaw("(SELECT tanggal FROM sbb WHERE id=$id) BETWEEN dari AND sampai")
                    ->first();
        
        $pdf = PDF::loadview('invent/atkrequestok.print',compact('data','isi','petugas','mengetahui'));
        return $pdf->stream();
    }



}
