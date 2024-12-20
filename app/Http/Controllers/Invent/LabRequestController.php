<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
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
use App\Labory;
use App\users;
use PDF;
use Carbon\Carbon;
use LogActivity;

class LabRequestController extends Controller
{
    public function index(Request $request)
    {   
        // $peg =auth()->user()->id;
        // $data = Sbb::orderBy('id','desc')
        //             ->select('sbb.*','users.name')
        //             ->leftJoin('users','users.id','=','sbb.users_id')
        //             ->where('sbb.jenis','L')
        //             ->where('sbb.users_id',$peg)
        //             ->when($request->keyword, function ($query) use ($request) {
        //                 $query->where('tanggal','LIKE','%'.$request->keyword.'%')
        //                         ->orWhere('nomor', 'LIKE','%'.$request->keyword.'%')
        //                         ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
        //             })
        //             ->paginate('10');
        $data = Inventaris::orderBy('inventaris.id','desc')
                            ->selectRaw('inventaris.*, users.name')
                            ->leftJoin('users','users.id','=','inventaris.penanggung_jawab')
                            ->leftJoin('entrystock','entrystock.inventaris_id','=','inventaris.id')
                            ->where('inventaris.kind','=','L')
                            ->groupBy('inventaris.id')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('nama_barang','LIKE','%'.$request->keyword.'%')
                                        ->orWhere('merk', 'LIKE','%'.$request->keyword.'%')
                                        ->where('inventaris.kind','=','L')
                                        ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                            })
                        ->paginate('25');

        return view('invent/labrequest.index',compact('data'));
    }

    public function create()
    {
        $data = Inventaris::orderBy('id','desc')
                            ->where('kind','=','L')
                            ->get();
        $user = User::all()
                ->where('id','!=','1');
        $lab = Labory::all();
        $jenis = Jenisbrg::where('kelompok','L')->where('aktif','Y')->get();
        $satuan = Satuan::all();
        // $tahu = Pejabat::selectraw('DISTINCT(jabatan_id), id, divisi_id, subdivisi_id, users_id, pjs')
        //                         -> whereraw('pjs is null and jabatan_id != 6')->Orderby('id','desc')->get();
        $tahu = User::where('aktif','Y')->where('status','PNS')->get();
        $nosbb = $this->getNoSBB();
        return view('invent/labrequest.create',compact('data','user','nosbb','satuan','jenis','lab','tahu'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'nomor' => 'required|unique:sbb',
            'tanggal' => 'required|date',
            'users_id'=> 'required',
        ]);

        DB::beginTransaction();
            $sbb =Sbb::create($request->all());
            $sbb_id = $sbb->id;
            for ($i = 0; $i < count($request->input('inventaris_id')); $i++){
                $data = [
                    'sbb_id' => $sbb_id,
                    'inventaris_id' => $request->inventaris_id[$i],
                    'satuan_id' => $request->satuan_id[$i] ,
                    'jumlah' => $request->jumlah[$i] ,
                    'jumlah_aju' => $request->jumlah_aju[$i] ,
                    'ket' => $request->ket[$i]
                ];
                Sbbdetail::create($data);
            }

            LogActivity::addToLog('Simpan->Pengajuan Barang Lab, nomor = '.$sbb->nomor.',id='.$sbb_id);

            DB::commit(); 
        return redirect('/invent/labrequest')->with('sukses','Data Berhasil Diperbaharui');
    }

    public function print($id)
    {
        $data = Sbb::where('id',$id)->first();
        $isi = Sbbdetail::where('sbb_id',$id)->get();
        $petugas = Petugas::where('id', '=', 4)->first();
        $kel = Sbbdetail::select('jenis_barang.nama')
                        ->leftjoin('inventaris','inventaris.id','=','sbb_detail.inventaris_id')
                        ->leftjoin('jenis_barang','jenis_barang.id','=','inventaris.jenis_barang')
                        ->where('sbb_id',$id)->first();

        $menyetujui = Pejabat::where('jabatan_id', '=', 11)
                    ->where('divisi_id', '=', 2)
                    ->whereRaw("(SELECT tanggal FROM sbb WHERE id=$id) BETWEEN dari AND sampai")
                    ->first();

        $mengetahui = pejabat::where('id',$data->pejabat_id)->first();
        $tahubaru = User::where('id',$data->mengetahui_id)->first();
        
        $jml  = Sbbdetail::SelectRaw('count(*) as hitung')   
                            ->where('sbb_id',$id)
                            ->first(); 

        if ($jml->hitung > 7 ) {
            $pdf = PDF::loadview('invent/labrequest.print',compact('data','isi','petugas','tahubaru','menyetujui','kel'));
            return $pdf->stream();
        } else {
            // $pdf = PDF::loadview('invent/labrequest.print',compact('data','isi','petugas','mengetahui','menyetujui','kel'));
            $pdf = PDF::loadview('invent/labrequest.print2',compact('data','isi','petugas','tahubaru','menyetujui','kel'));
            return $pdf->stream();
        }
        
    }

    public function getBarang(Request $request)
    {
        $id = $request->barang_id;

        $data =Inventaris::SelectRaw('inventaris.*,  entrystock.stock, satuan.satuan' )
               ->LeftJoin(DB::raw("(SELECT MAX(id) as max_id, inventaris_id FROM entrystock GROUP BY inventaris_id) stok"),
                                        'stok.inventaris_id','=','inventaris.id')
               ->LeftJoin('entrystock','stok.max_id','=','entrystock.id')
               ->leftJoin('satuan', 'inventaris.satuan_id', '=', 'satuan.id')
                ->where('inventaris.id',$id)
                ->first();
        return response()->json([ 'success' => true,'data' => $data],200);
    }

    public function getKelompok(Request $request)
    {
        $id = $request->jenis_barang;

        $data = Inventaris::where('jenis_barang',$id)
                            ->where('kind','L')
                            ->get();
        return response()->json([ 'success' => true,'data' => $data],200);
    }
   
    
    function getNoSBB(){
      $nomor = Sbb::orderBy('id','desc')->whereYear('tanggal',date('Y'))->get();
      $counting = Sbb::SelectRaw("COUNT(*)AS jum ")->whereYear('tanggal',date('Y'))->first();
      $first = "001";
      if($nomor->count()>0){
        $first = $counting->jum+1;
        if($first < 10){
            $first = "00".$first;
        }else if($first < 100){
            $first = "0".$first;
        }
      }
      $nosbb = $first."/SBB/LAB/BBPOM/".date('m')."/".date('Y');
      return $nosbb;
    }

    public function ubah($id)
    {
        $lab = Labory::all();
        $data = Sbb::where('id',$id)->first();
        $ajuan = Sbbdetail::where('sbb_id',$id)->get();
        // $tahu = Pejabat::selectraw('DISTINCT(jabatan_id), id, divisi_id, subdivisi_id, users_id, pjs')
        //                 -> whereraw('pjs is null and jabatan_id != 6')->Orderby('id','desc')->get();
        $tahu = User::where('aktif','Y')->where('status','PNS')->get();
        $jenis = Jenisbrg::where('kelompok','L')->where('aktif','Y')->get();
        $kel = Sbbdetail::where('sbb_id',$id)->first();
        $inv = Inventaris::where('jenis_barang',$kel->barang->jenis->id)->get();

        return view('invent/labrequest.ubah',compact('data','ajuan','tahu','jenis','kel','inv','lab'));
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
                    'jumlah_aju' => $request->jumlah_aju[$i] ,
                    'ket' => $request->ket[$i]

                ];
                Sbbdetail::create($data);
            }
        DB::commit(); 

        LogActivity::addToLog('Ubah->Pengajuan Barang Lab, nomor = '.$sbb->nomor.',id='.$id);
        return redirect('/invent/labrequest')->with('sukses','Data Berhasil Diperbaharui');
    }

    public function getExp(Request $request)
    {
        $inventaris_id = $request->barang_id;

        $data = entrystock::where('inventaris_id',$inventaris_id)
                            ->where('stockawal', '!=', '0')
                            ->orderby('id','desc')
                            ->first();
        return response()->json([ 'success' => true,'data' => $data],200);
    }

    public function updatestat(Request $request, $id)
    {
        $data = Sbb::find($id);
        $data->update($request->all());
        return redirect('/invent/atkrequest')->with('sukses','Data Berhasil Diperbaharui');
    }


}
