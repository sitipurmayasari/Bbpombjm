<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\AduanDetail;
use Carbon\Carbon;
use App\Inventaris;
use App\Aduan;
use App\User;
use App\Pejabat;
use App\Petugas;
use App\Divisi;
use App\ItAsset;
use App\AduanTIK;
use PDF;
use LogActivity;


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

        $data2 = AduanTIK::orderBy('status','asc')
                    ->orderBy('id','desc')
                    ->select('aduantik.*')
                    ->leftJoin('users','users.id','=','aduantik.users_id')
                    ->leftJoin('itasset','itasset.id','=','aduantik.itasset_id')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('no_aduan','LIKE','%'.$request->keyword.'%')
                                ->orWhere('itasset.nama_barang', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('tanggal', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('users.name', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('invent/aduantik.index',compact('data','data2'));
    }

    public function bidang(Request $request)
    {   
        $div =auth()->user()->divisi_id;
        $divisi = Divisi::where('id',$div)->first();
        $data = AduanTIK::orderBy('status','asc')
                        ->orderBy('id','desc')
                        ->select('aduantik.*')
                        ->leftJoin('users','users.id','=','aduantik.users_id')
                        ->leftJoin('itasset','itasset.id','=','aduantik.itasset_id')
                        ->where('aduantik.divisi_id',$div)
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('no_aduan','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('itasset.nama_barang', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('tanggal', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('users.name', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('invent/aduantik.bidang',compact('data','divisi'));
    }

    public function create()
    {

        $div = auth()->user()->divisi_id;
        $user = User::where('id','!=','1')->where('aktif','=','Y')->where('divisi_id','=',$div)->get();
        $data = ItAsset::all();
        $no_aduan = $this->getNoAduan();
        return view('invent/aduantik.create',compact('data','user','no_aduan','div'));
    }

    public function create2()
    {
        $user = User::where('id','!=','1')->where('aktif','=','Y')->get();
        $data = ItAsset::all();
        $no_aduan = $this->getNoAduan();
        return view('invent/aduantik.create2',compact('data','user','no_aduan'));
    }

    public function edit($id)
    {
        $inventaris = Inventaris::all()
                ->where('kind','=','R')
                ->where('jenis_barang','=','4');
        $data = Aduan::where('id',$id)->first();
       return view('invent/aduantik.edit',compact('data','inventaris'));
    }

    public function edit2($id)
    {
        $inventaris = ItAsset::all();
        $data = AduanTIK::where('id',$id)->first();
       return view('invent/aduantik.edit2',compact('data','inventaris',));
    }


    public function detail($id)
    {
       $aduan = Aduan::where('id',$id)->first();
       return view('invent/aduantik.detail',compact('aduan'));
    }

    public function detail2($id)
    {
       $aduan = AduanTIK::where('id',$id)->first();
       return view('invent/aduantik.detail2',compact('aduan'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'no_aduan'      => 'required|unique:aduan',
            'tanggal'       => 'required|date'
        ]);

        $aduan = AduanTIK::create($request->all());
        $aduan_id = $aduan->id;

        LogActivity::addToLog('Simpan->Aduan Kerusakan TIK, No. Aduan = '.$request->no_aduan);

        if ($request->lokasi != null) {
            return redirect('/invent/aduantik');
        } else {
            return redirect('/invent/aduantik/bidang');
        }

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
                'result'        => $request->result,
                'aduan_status'  => $request->aduan_status,
                'follow_up'     => $request->follow_up,
                'analyze_date'  => $request->analyze_date
        ]);
        LogActivity::addToLog('Update Status->Aduan Kerusakan TIK, No. Aduan = '.$aduan->no_aduan);
        return redirect('/invent/aduantik')->with('sukses','Status Aduan Telah Diperbaharui');
    }

    public function update2(Request $request, $id)
    {
        $aduan = AduanTIK::find($id);
        $aduan->update(
            [
                'result'        => $request->result,
                'follow_up'     => $request->follow_up,
                'analyze_date'  => $request->analyze_date,
                'status'        => $request->status,
        ]);
        LogActivity::addToLog('Update Status->Aduan Kerusakan TIK, No. Aduan = '.$aduan->no_aduan);
        return redirect('/invent/aduantik')->with('sukses','Status Aduan Telah Diperbaharui');
    }

    public function perbaharui(Request $request, $id)
    {
        $data = Aduan::find($id);
        $data->update($request->all());
        LogActivity::addToLog('Ubah->Aduan Kerusakan TIK, No. Aduan = '.$data->no_aduan);
        return redirect('/invent/aduantik/bidang')->with('sukses','Data Diperbaharui');
    }

    public function perbaharui2(Request $request, $id)
    {
        $data = AduanTIK::find($id);
        $data->update($request->all());
        LogActivity::addToLog('Ubah->Aduan Kerusakan TIK, No. Aduan = '.$data->no_aduan);
        return redirect('/invent/aduantik/bidang')->with('sukses','Data Diperbaharui');
    }

    function getNoAduan(){
        $aduan = AduanTIK::orderBy('id','desc')->whereYear('tanggal',date('Y'))->get(); // get last no aduan berdasarkan reset per tahun
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
        LogActivity::addToLog('Hapus->Aduan Kerusakan TIK, No. Aduan = '.$data->no_aduan);
        $data->delete();
        
        return redirect('/invent/aduantik/bidang')->with('sukses','Data Terhapus');
    }

    public function delete2($id)
    {
        $data = AduanTIK::find($id);
        LogActivity::addToLog('Hapus->Aduan Kerusakan TIK, No. Aduan = '.$data->no_aduan);
        $data->delete();
        return redirect('/invent/aduantik/bidang')->with('sukses','Data Terhapus');
    }

    public function print2($id)
    {
        $data = AduanTIK::where('id',$id)->first();

        $pejabat = Pejabat::all();

        $petugas = Petugas::where('id', '=', 1)->first();

        $petugastik = Petugas::where('id', '=', 6)->first();

        $menyetujui = Pejabat::
                        where('jabatan_id', '=', 11)
                        ->where('divisi_id', '=', 2)
                        ->whereRaw("(SELECT tanggal FROM aduantik WHERE id=$id) BETWEEN dari AND sampai")
                        ->first();
            
            $jab = User::leftjoin('aduantik','aduantik.users_id','=','users.id')
                        ->where('aduantik.id',$id)->first();
    
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

        
        $pdf = PDF::loadview('invent/aduantik.printbaru',compact('data','menyetujui','petugas','pejabat','mengetahui','petugastik'));
        return $pdf->stream();
    }

    public function printhasil2($id)
    {
        $data = AduanTIK::where('id',$id)->first();

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
        
        $pdf = PDF::loadview('invent/aduantik.printhasilbaru',compact('data','menyetujui','petugas','pejabat','mengetahui','petugastik'));
        return $pdf->stream();
    }


    public function getbidangadu(Request $request)
    {
        $id = $request->users_id;

        $data =Divisi::selectRaw('divisi.*')
                    ->LeftJoin('users','users.divisi_id','divisi.id')
                    ->where('users.id',$id)
                    ->first();
        return response()->json([ 'success' => true,'data' => $data],200);
    }

    public function getbarang(Request $request)
    {
        $id = $request->id;

        $data =ItAsset::selectRaw('itasset.*, users.name AS pj, jenistik.kelompok')
                    ->leftJoin('users','users.id','itasset.users_id')
                    ->leftJoin('jenistik','jenistik.id','itasset.jenistik_id')
                    ->where('itasset.id',$id)
                    ->first();
        return response()->json([ 'success' => true,'data' => $data],200);
    }
}