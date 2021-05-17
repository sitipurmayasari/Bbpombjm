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
use PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarangkeluarController extends Controller
{
    public function index(Request $request)
    {   
        $data = Sbb::orderBy('id','desc')
                    ->select('sbb.*','users.name')
                    ->leftJoin('users','users.id','=','sbb.users_id')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('tanggal','LIKE','%'.$request->keyword.'%')
                                ->orWhere('nomor', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('invent/barangkeluar.index',compact('data'));
    }

    public function create()
    {
        $data = Inventaris::all();
        $user = User::where('id','!=','1');
        $satuan = Satuan::all();
        $nosbb = $this->getNoSBB();
        return view('invent/barangkeluar.create',compact('data','user','nosbb','satuan'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'nomor' => 'required|unique:Sbb',
            'tanggal' => 'required|date',
            'users_id'=> 'required'
        ]);

        DB::beginTransaction(); // kegunaan untuk multiple insert (banyak aksi k database)
            $sbb =Sbb::create($request->all());
            $sbb_id = $sbb->id;
            for ($i = 0; $i < count($request->input('inventaris_id')); $i++){
                $data = [
                    'sbb_id' => $sbb_id,
                    'inventaris_id' => $request->inventaris_id[$i],
                    'satuan_id' => $request->satuan_id[$i] ,
                    'jumlah' => $request->jumlah[$i] ,
                    'ket' => $request->ket[$i]
                ];
                Sbbdetail::create($data);

                Inventaris::where('id',$request->inventaris_id[$i])->update([
                'jumlah_barang' => $request->sisa[$i]
                ]);

            }
            DB::commit(); 
        return redirect('/invent/barangkeluar/print/'.$sbb_id);
    }

    public function print($id)
    {
        $data = Sbb::where('id',$id)->first();
        $isi = Sbbdetail::where('sbb_id',$id)->get();
        $petugas = Petugas::where('id', '=', 4)->first();

        $mengetahui = Pejabat::where('jabatan_id', '=', 11)
                    ->where('divisi_id', '=', 2)
                    ->whereRaw("(SELECT tanggal FROM aduan WHERE id=$id) BETWEEN dari AND sampai")
                    ->first();
        
        $pdf = PDF::loadview('invent/barangkeluar.print',compact('data','isi','petugas','mengetahui'));
        return $pdf->stream();
    }

   
    // public function edit($id)
    // {
    //     $barang = Inventaris::all();
    //     $user = User::where('id','!=','1');
    //     $data = Sbb::where('id',$id)->first();
    //     $detail = Sbbdetail::where('tukin_id',$id)->get();

    //     return view('invent/barangkeluar.edit',compact('data','detail','user','barang'));
    // }

   
    // public function update(Request $request, $id)
    // {
    //     $aduan = Aduan::find($id);
    //     for ($i = 0; $i < count($request->input('detail_id')); $i++){
    //         $detail_id = $request->detail_id[$i];
    //         AduanDetail::where('id',$detail_id)->update([
    //             'status' => $request->status[$i]
    //         ]);
    //     }
    //     $aduan->update(['aduan_status' => $request->aduan_status]);
    //     return redirect('/invent/aduan/detail/'.$id)->with('sukses','Barang sudah diperbaharui');
    // }


    function getNoSBB(){
      $nomor = Sbb::orderBy('id','desc')->whereYear('tanggal',date('Y'))->get();
      $first = "001";
      if($nomor->count()>0){
        $first = $nomor->first()->id+1;
        if($first < 10){
            $first = "00".$first;
        }else if($first < 100){
            $first = "0".$first;
        }
      }
      $nosbb = $first."/SBBK/BBPOM/".date('m')."/".date('Y');
      return $nosbb;
    }


}
