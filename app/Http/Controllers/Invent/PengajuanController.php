<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Pejabat;
use App\Petugas;
use App\Pengajuan;
use App\PengajuanDetail;
use App\Satuan;
use PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {   
        $detail = PengajuanDetail::all();
        $data = Pengajuan::orderBy('status','asc')
                    ->select('pengajuan.*','users.name')
                    ->leftJoin('users','users.id','=','pengajuan.pegawai_id')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('no_ajuan','LIKE','%'.$request->keyword.'%')
                                ->orWhere('tgl_ajuan', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('kelompok', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('invent/pengajuan.index',compact('data','detail'));
    }

    public function create()
    {
        $user = User::all()
                ->where('id','!=','1');
        $satuan = Satuan::all();
        $no_ajuan = $this->getNoAjuan();
        return view('invent/pengajuan.add',compact('user','no_ajuan','satuan'));
    }

    public function detail($id)
    {
       $ajuan = Pengajuan::find($id);
       $detail = pengajuanDetail::where('pengajuan_id',$id)->get();
       return view('invent/pengajuan.detail',compact('ajuan','detail'));
    }

   
    public function store(Request $request)
    {

        $this->validate($request,[
            'no_ajuan' => 'required|unique:pengajuan',
            'tgl_ajuan' => 'required|date',
            'pegawai_id'=> 'required',
            'kelompok'=> 'required'
        ]);

        DB::beginTransaction(); // kegunaan untuk multiple insert (banyak aksi k database)
            $pengajuan =Pengajuan::create($request->all());
            $pengajuan_id = $pengajuan->id;
            for ($i = 0; $i < count($request->input('nama_barang')); $i++){
                $data = [
                    'pengajuan_id' => $pengajuan_id,
                    'nama_barang' => $request->nama_barang[$i],
                    'satuan_id' => $request->satuan_id[$i] ,
                    'jumlah' => $request->jumlah[$i] ,
                    'keperluan' => $request->keperluan[$i]
                ];
                PengajuanDetail::create($data);
            }
        DB::commit(); 

        return redirect('/invent/pengajuan/print/'.$pengajuan_id);

    }

    public function print($id)
    {
        $data = Pengajuan::where('id',$id)->first();
        $isi = PengajuanDetail::where('pengajuan_id',$id)

        ->get();

        $pejabat = Pejabat::all();

        $petugas = Petugas::where('id', '=', 3)->first();

        $menyetujui = Pejabat::
                        where('jabatan_id', '=', 11)
                        ->where('divisi_id', '=', 2)
                        ->whereRaw("curdate() BETWEEN dari AND sampai")
                        ->first();

        $mengetahui = Pejabat::orderBy('subdivisi_id','desc')
                       ->whereRaw("divisi_id =
                                    (
                                        SELECT u.divisi_id FROM users u
                                        LEFT JOIN pengajuan a ON a.pegawai_id=u.id
                                        WHERE a.id=$id
                                    )" )
                        ->whereRaw(" 
                                    (subdivisi_id =
                                    (
                                        SELECT u.subdivisi_id FROM users u 
                                        LEFT JOIN pengajuan a ON a.pegawai_id=u.id 
                                        WHERE a.id=$id
                                    ) OR subdivisi_id IS NULL)
                                ")
                        ->whereRaw("curdate() BETWEEN dari AND sampai")
                        ->first();
        
        $pdf = PDF::loadview('invent/pengajuan.print',compact('data','isi','menyetujui','petugas','pejabat','mengetahui'));
        return $pdf->stream();
    }

   
    public function update(Request $request, $id)
    {
        $pengajuan = Pengajuan::find($id);
        for ($i = 0; $i < count($request->input('detail_id')); $i++){
            $detail_id = $request->detail_id[$i];
            PengajuanDetail::where('id',$detail_id)->update([
                'status' => $request->status[$i]
            ]);
        }
        $pengajuan->update(['status' => $request->aduan_status]);
        return redirect('/invent/pengajuan/detail/'.$id)->with('sukses','Barang sudah diperbaharui');
    }


    function getNoAjuan(){
      $ajuan = Pengajuan::orderBy('id','desc')->whereYear('tgl_ajuan',date('Y'))->get(); 
      $first = "001";
      if($ajuan->count()>0){
        $first = $ajuan->first()->id+1;
        if($first < 10){
            $first = "00".$first;
        }else if($first < 100){
            $first = "0".$first;
        }
      }
      $no_ajuan = $first."/SPB/BBPOM/".date('m')."/".date('Y');
      return $no_ajuan;
    }


}
