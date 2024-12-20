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
use App\Teamleader;
use App\Jenisbrg;
use App\Entrystock;
use App\Labory;
use PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use LogActivity;

class BarangkeluarController extends Controller
{
    public function index(Request $request)
    {   
        $data = Sbb::orderBy('id','desc')
                    // ->select('sbb.*','users.name')
                    // ->leftJoin('users','users.id','=','sbb.users_id')
                    ->where('sbb.stat_aduan','!=','B')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->whereHas('isi', function ($query2) use ($request) {
                            // $query2->where('inventaris_id', 'LIKE', '%'.$request->keyword.'%');
                            $query2->whereHas('barang', function ($query3) use ($request) {
                                $query3->where('nama_barang','LIKE','%'.$request->keyword.'%');
                            });
                                    
                        })
                        ->orwhereHas('pegawai', function ($query3) use ($request) {
                            $query3->where('name','LIKE','%'.$request->keyword.'%');
                        })
                        ->orwhere('tanggal','LIKE','%'.$request->keyword.'%')
                        ->orWhere('nomor', 'LIKE','%'.$request->keyword.'%');
                        // ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('invent/barangkeluar.index',compact('data'));
    }

    public function create()
    {
        $data = Inventaris::select('inventaris.*','entrystock.exp_date','entrystock.id AS st_id')
                            ->leftJoin('entrystock','entrystock.inventaris_id','=','inventaris.id')
                            ->where('inventaris.kind','!=','R')
                        ->get();
        $user = User::all()->where('aktif','Y')
                ->where('id','!=','1');
        $satuan = Satuan::all();
        $nosbb = $this->getNoSBB();
        $lab = Labory::all();
        $tahu  = Teamleader::where('aktif','Y')->get();
        $jenis = Jenisbrg::where('aktif','Y')->get();
        return view('invent/barangkeluar.create',compact('data','user','nosbb','satuan','tahu','jenis','lab'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'nomor' => 'required|unique:sbb',
            'tanggal' => 'required|date',
            'users_id'=> 'required'
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
                    'jumlah_aju' => $request->jumlah_aju[$i],
                    'ket' => $request->ket[$i],
                    'status' => $request->status[$i]
                ];
                Sbbdetail::create($data);

                // potong stock
                if ($request->status[$i] == 'Y') {
                    $stok = [
                        'entry_date' => $request->tanggal,
                        'inventaris_id' => $request->inventaris_id[$i],
                        'stock' => $request->sisa[$i],
                        'keluar' => $request->jumlah[$i],
                        'keterangan' => $request->ket[$i]
                        ];
                     Entrystock::create($stok);
                }
               

            }
            DB::commit(); 
        return redirect('/invent/barangkeluar')->with('sukses','Data Tersimpan');
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
        
        $pdf = PDF::loadview('invent/barangkeluar.print',compact('data','isi','petugas','mengetahui'));
        return $pdf->stream();
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

        $data = Inventaris::where("jenis_barang",$id)
                            ->where("kind","!=","R")
                            ->get();
        return response()->json([ 'success' => true,'data' => $data],200);
    }
   
    public function edit($id)
    {
        $data = Sbb::where('id',$id)->first();
        $detail = Sbbdetail::where('sbb_id',$id)->get();

        return view('invent/barangkeluar.edit',compact('data','detail'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'status'=> 'required'
        ]);

        DB::beginTransaction(); 
            $sbb = Sbb::find($id);
            $sbb->update($request->all());
            //update sbb
            for ($i = 0; $i < count($request->input('inventaris_id')); $i++){

                $data = [
                    'sbb_id' => $id,
                    'inventaris_id' => $request->inventaris_id[$i],
                    'satuan_id' => $request->satuan_id[$i] ,
                    'jumlah' => $request->jumlah[$i] ,
                    'jumlah_aju' => $request->jumlah_aju[$i],
                    'ket' => $request->ket[$i],
                    'status' => $request->status[$i]
                ];
                Sbbdetail::updateOrCreate([
                  'id'   => $request->stuff_id[$i],
                ],$data);

                if ($request->status[$i] == 'Y') {
                    $stok = [
                        'entry_date' => $request->today,
                        'inventaris_id' => $request->inventaris_id[$i],
                        'stock' => $request->sisa[$i],
                        'keluar' => $request->jumlah[$i]
                        ];
                     Entrystock::create($stok);
                }
            }

            LogActivity::addToLog('Menyetujui->Barang Keluar, nomor = '.$sbb->nomor.',id='.$id);
        DB::commit(); 

        return redirect('/invent/barangkeluar')->with('sukses','Data Tersimpan');
        
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
        $nosbb = $first."/SBBK/BBPOM/".date('m')."/".date('Y');
        return $nosbb;
    }

    
    public function daftarbrg($id)
    {
        $data = Sbb::where('id',$id)->first();
        $isi = Sbbdetail::where('sbb_id',$id)->get();
        $pdf = PDF::loadview('invent/barangkeluar.daftarbrg',compact('data','isi'));
        return $pdf->stream();
    }


}
