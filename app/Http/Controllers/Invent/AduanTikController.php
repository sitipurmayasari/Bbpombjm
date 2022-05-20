<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventaris;
use App\Aduan;
use App\User;
use App\Pejabat;
use App\Petugas;
use App\Divisi;
use PDF;
use Illuminate\Support\Facades\DB;
use App\AduanDetail;
use Carbon\Carbon;

class AduanTikController extends Controller
{
    public function index(Request $request)
    {   
        $data = Aduan::orderBy('aduan_status','asc')
                    ->orderBy('id','desc')
                    ->select('aduan.*','users.name')
                    ->leftJoin('users','users.id','=','aduan.pegawai_id')
                    ->where('aduan.jenis','=','T')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('no_aduan','LIKE','%'.$request->keyword.'%')
                                ->orWhere('tanggal', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('invent/aduantik.index',compact('data'));
    }

    public function bidang(Request $request)
    {   
        $div =auth()->user()->divisi_id;
        $data = Aduan::orderBy('aduan_status','asc')
                    ->orderBy('id','desc')
                    ->select('aduan.*','users.name')
                    ->leftJoin('users','users.id','=','aduan.pegawai_id')
                    ->where('aduan.jenis','=','T')
                    ->where('aduan.divisi_id','=',$div)
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('no_aduan','LIKE','%'.$request->keyword.'%')
                                ->orWhere('tanggal', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        $divisi = Divisi::where('id',$div)->first();
        return view('invent/aduantik.bidang',compact('data','divisi'));
    }

    public function create()
    {

        $div = auth()->user()->divisi_id;
        $user = User::where('id','!=','1')->where('aktif','=','Y')->where('divisi_id','=',$div)->get();
        $data = Inventaris::all()
                ->where('kind','=','R')
                ->where('jenis_barang','=','4');
        $no_aduan = $this->getNoAduan();
        return view('invent/aduantik.create',compact('data','user','no_aduan','div'));
    }

    public function edit($id)
    {
        $inventaris = Inventaris::all()
                ->where('kind','=','R')
                ->where('jenis_barang','=','4');
        $data = Aduan::where('id',$id)->first();
       return view('invent/aduantik.edit',compact('data','inventaris'));
    }

    public function detail($id)
    {
       $aduan = Aduan::where('id',$id)->first();
       return view('invent/aduantik.detail',compact('aduan'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'no_aduan'      => 'required|unique:aduan',
            'tanggal'       => 'required|date',
            'pegawai_id'    => 'required',
            'inventaris_id' => 'required',
            'problem'       => 'required'
        ]);

        $aduan = Aduan::create($request->all());
        $aduan_id = $aduan->id;
        return redirect('/invent/aduantik/print/'.$aduan_id);

    }

    public function print($id)
    {
        $data = Aduan::where('id',$id)->first();

        $pejabat = Pejabat::all();

        $petugas = Petugas::where('id', '=', 1)->first();

        $petugastik = Petugas::where('id', '=', 6)->first();

        $menyetujui = Pejabat::
                        where('jabatan_id', '=', 11)
                        ->where('divisi_id', '=', 2)
                        ->whereRaw("(SELECT tanggal FROM aduan WHERE id=$id) BETWEEN dari AND sampai")
                        ->first();
            
            $jab = User::leftjoin('aduan','aduan.pegawai_id','=','users.id')
                        ->where('aduan.id',$id)->first();
    
            if ($jab->jabatan_id == '11') {
                $mengetahui = Pejabat::orderBy('id','desc')
                                    ->Where('jabatan_id',6)->whereRaw("curdate() BETWEEN dari AND sampai")->first();
            
            } else if ($jab->jabatan_id == '7') {
                $mengetahui = Pejabat::orderBy('id','desc')
                                    ->Where('jabatan_id',6)->whereRaw("curdate() BETWEEN dari AND sampai")->first();
            } else if ($jab->jabatan_id == '8') {
                if ($jab->subdivisi_id != null) {
                    $mengetahui = Pejabat::orderBy('id','desc')
                                    ->whereRaw("subdivisi_id =
                                                    ( SELECT u.subdivisi_id FROM users u 
                                                        LEFT JOIN aduan a ON a.pegawai_id=u.id 
                                                        WHERE a.id=$id
                                                )" )
                                    ->whereRaw("curdate() BETWEEN dari AND sampai")
                                    ->first();
                } else {
                    $mengetahui = Pejabat::orderBy('id','desc')
                    ->whereRaw("divisi_id =
                                (SELECT u.divisi_id FROM users u
                                    LEFT JOIN aduan a ON a.pegawai_id=u.id
                                    WHERE a.id=$id
                                )" )
                    ->whereRaw('subdivisi_id is null')
                    ->whereRaw("curdate() BETWEEN dari AND sampai")
                    ->first();
                }
                
            } else {
                $mengetahui = Pejabat::orderBy('id','desc')
                                    ->whereRaw("divisi_id =
                                                (SELECT u.divisi_id FROM users u
                                                    LEFT JOIN aduan a ON a.pegawai_id=u.id
                                                    WHERE a.id=$id
                                                )" )
                                    ->whereRaw('subdivisi_id is null')
                                    ->whereRaw("curdate() BETWEEN dari AND sampai")
                                    ->first();
               
            }

        
        $pdf = PDF::loadview('invent/aduantik.print',compact('data','menyetujui','petugas','pejabat','mengetahui','petugastik'));
        return $pdf->stream();
    }

    public function printhasil($id)
    {
        $data = Aduan::where('id',$id)->first();

        $pejabat = Pejabat::all();

        $petugas = Petugas::where('id', '=', 1)->first();

        $petugastik = Petugas::where('id', '=', 6)->first();

        $menyetujui = Pejabat::
                        where('jabatan_id', '=', 11)
                        ->where('divisi_id', '=', 2)
                        ->whereRaw("(SELECT tanggal FROM aduan WHERE id=$id) BETWEEN dari AND sampai")
                        ->first();

        $mengetahui = Pejabat::orderBy('subdivisi_id','desc')
                       ->whereRaw("divisi_id =
                                    (
                                        SELECT u.divisi_id
                                        FROM users u
                                        LEFT JOIN aduan a ON a.pegawai_id=u.id
                                        WHERE a.id=$id
                                    )" )
                        ->whereRaw(" 
                                    (subdivisi_id =
                                    (
                                        SELECT u.subdivisi_id
                                        FROM users u
                                        LEFT JOIN aduan a ON a.pegawai_id=u.id
                                        WHERE a.id=$id
                                    ) OR subdivisi_id IS NULL)
                                ")
                        ->whereRaw("(SELECT tanggal FROM aduan WHERE id=$id) BETWEEN dari AND sampai")
                        ->first();
        
        $pdf = PDF::loadview('invent/aduantik.printhasil',compact('data','menyetujui','petugas','pejabat','mengetahui','petugastik'));
        return $pdf->stream();
    }
   
    public function update(Request $request, $id)
    {
        $aduan = Aduan::find($id);
        $aduan->update(
            [
                'result' => $request->result,
                'aduan_status' => $request->aduan_status,
                'follow_up' => $request->follow_up,
        ]);
        return redirect('/invent/aduantik')->with('sukses','Status Aduan Telah Diperbaharui');
    }

    public function perbaharui(Request $request, $id)
    {
        $data = Aduan::find($id);
        $data->update($request->all());
        return redirect('/invent/aduantik/bidang')->with('sukses','Data Diperbaharui');
    }


    function getNoAduan(){
      $aduan = Aduan::orderBy('id','desc')->whereYear('tanggal',date('Y'))->get(); // get last no aduan berdasarkan reset per tahun
      $first = "001";
      if($aduan->count()>0){
        $first = $aduan->first()->id+1;
        if($first < 10){
            $first = "00".$first;
        }else if($first < 100){
            $first = "0".$first;
        }
      }
      $no_aduan = $first."/SPTIK/BBPOM/".date('m')."/".date('Y');
      return $no_aduan;
    }

    public function delete($id)
    {
        $data = Aduan::find($id);
        $data->delete();
        return redirect('/invent/aduantik/bidang')->with('sukses','Data Terhapus');
    }


}
