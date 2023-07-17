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
use App\Jenisbrg;
use App\Inventaris;
use PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {   
        $peg =auth()->user()->id;
        $data = Pengajuan::orderBy('pengajuan.id','desc')
                    ->where('pegawai_id',$peg)
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('no_ajuan','LIKE','%'.$request->keyword.'%')
                                ->orWhere('tgl_ajuan', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('kelompok', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('invent/pengajuan.index',compact('data'));
    }

    public function create()
    {
        $user = User::all()
                ->where('id','!=','1');
        $satuan = Satuan::all();
        $kelompok = Jenisbrg::all();
        $no_ajuan = $this->getNoAjuan();
        return view('invent/pengajuan.add',compact('user','no_ajuan','satuan','kelompok'));
    }
   
    public function store(Request $request)
    {

        $this->validate($request,[
            'no_ajuan' => 'required|unique:pengajuan',
            'tgl_ajuan' => 'required|date',
            'pegawai_id'=> 'required',
            'jenis_barang_id'=> 'required'
        ]);

        DB::beginTransaction(); // kegunaan untuk multiple insert (banyak aksi k database)
            $pengajuan =Pengajuan::create($request->all());
            $pengajuan_id = $pengajuan->id;
            for ($i = 0; $i < count($request->input('nama_barang')); $i++){
                $data = [
                    'pengajuan_id' => $pengajuan_id,
                    'nama_barang' => $request->nama_barang[$i],
                    'satuan_id' => $request->satuan_id[$i],
                    'inventaris_id' => $request->inventaris_id[$i],
                    'jumlah' => $request->jumlah[$i],
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
        $isi = PengajuanDetail::where('pengajuan_id',$id)->get();

        $jab = User::Select('jabatan_id','divisi_id','subdivisi_id')
                    ->leftjoin('pengajuan','pengajuan.pegawai_id','=','users.id')
                    ->where('pengajuan.id',$id)->first();

        if ($jab->jabatan_id == '11') {
            $mengetahui = Pejabat::orderBy('id','desc')
                                ->Where('jabatan_id',6)->whereRaw("curdate() BETWEEN dari AND sampai")->first();
        
        } else if ($jab->jabatan_id == '7') {
            $mengetahui = Pejabat::orderBy('id','desc')
                                ->Where('jabatan_id',6)->whereRaw("curdate() BETWEEN dari AND sampai")->first();
        } else if ($jab->jabatan_id == '5') {
            $mengetahui = Pejabat::orderBy('id','desc')
                                ->whereRaw("divisi_id =
                                            (SELECT u.divisi_id FROM users u
                                                LEFT JOIN pengajuan a ON a.pegawai_id=u.id
                                                WHERE a.id=$id
                                            )" )
                                ->whereRaw('subdivisi_id is null')
                                ->whereRaw("curdate() BETWEEN dari AND sampai")
                                ->first();
        } else if ($jab->jabatan_id == '8') {
            $mengetahui = Pejabat::orderBy('id','desc')
                                    ->whereRaw("divisi_id =
                                                (SELECT u.divisi_id FROM users u
                                                    LEFT JOIN pengajuan a ON a.pegawai_id=u.id
                                                        WHERE a.id=$id
                                                )" )
                                    ->whereRaw('subdivisi_id is null')
                                    ->whereRaw("curdate() BETWEEN dari AND sampai")
                                    ->first();
        
        }
        
        $pdf = PDF::loadview('invent/pengajuan.print',compact('data','isi','mengetahui'));
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
      $counting = Pengajuan::SelectRaw("COUNT(*)AS jum ")->whereYear('tgl_ajuan',date('Y'))->first();
      $first = "001";
      if($ajuan->count()>0){
        $first = $counting->jum+1;
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
