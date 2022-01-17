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

class LabRequestController extends Controller
{
    public function index(Request $request)
    {   
        $data = Sbb::orderBy('id','desc')
                    ->select('sbb.*','users.name')
                    ->leftJoin('users','users.id','=','sbb.users_id')
                    ->where('sbb.jenis','L')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('tanggal','LIKE','%'.$request->keyword.'%')
                                ->orWhere('nomor', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('invent/labrequest.index',compact('data'));
    }

    public function create()
    {
        $data = Inventaris::orderBy('id','desc')
                            ->where('kind','=','L')
                            ->get();
        $user = User::all()
                ->where('id','!=','1');
        $jenis = Jenisbrg::whereRaw('id IN (2,3)')->get();
        $satuan = Satuan::all();
        $nosbb = $this->getNoSBB();
        return view('invent/labrequest.create',compact('data','user','nosbb','satuan','jenis'));
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
                    'ket' => $request->ket[$i]
                ];
                Sbbdetail::create($data);

                // Entrystock::where('id',$request->st_id[$i])->update([
                // 'stock' => $request->sisa[$i]
                // ]);

            }
            DB::commit(); 
        return redirect('/invent/labrequest/print/'.$sbb_id);
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
                    ->whereRaw("(SELECT tanggal FROM aduan WHERE id=$id) BETWEEN dari AND sampai")
                    ->first();
        $mengetahui = Pejabat::orderBy('subdivisi_id','desc')
                    ->whereRaw("divisi_id =
                                 (
                                     SELECT u.divisi_id FROM users u
                                     LEFT JOIN sbb a ON a.users_id=u.id
                                     WHERE a.id=$id
                                 )" )
                     ->whereRaw(" 
                                 (subdivisi_id =
                                 (
                                     SELECT u.subdivisi_id FROM users u 
                                     LEFT JOIN sbb a ON a.users_id=u.id 
                                     WHERE a.id=$id
                                 ) OR subdivisi_id IS NULL)
                             ")
                     ->whereRaw("curdate() BETWEEN dari AND sampai")
                     ->first();
        
        $pdf = PDF::loadview('invent/labrequest.print',compact('data','isi','petugas','mengetahui','menyetujui','kel'));
        return $pdf->stream();
    }

    public function getBarang(Request $request)
    {
        $id = $request->barang_id;

        $data = Inventaris::selectRaw('inventaris.id, inventaris.nama_barang, inventaris.satuan_id, satuan.satuan, SUM(entrystock.stock) AS sisa')
                    ->leftJoin('satuan', 'inventaris.satuan_id', '=', 'satuan.id')
                    ->leftJoin('entrystock','entrystock.inventaris_id','=','inventaris.id')
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
      $first = "001";
      if($nomor->count()>0){
        $first = $nomor->first()->id+1;
        if($first < 10){
            $first = "00".$first;
        }else if($first < 100){
            $first = "0".$first;
        }
      }
      $nosbb = $first."/SBB/LAB/BBPOM/".date('m')."/".date('Y');
      return $nosbb;
    }


}
