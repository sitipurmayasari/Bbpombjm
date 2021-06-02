<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventaris;
use App\Aduan;
use App\User;
use App\Pejabat;
use App\Petugas;
use PDF;
use Illuminate\Support\Facades\DB;
use App\AduanDetail;
use Carbon\Carbon;

class AduanController extends Controller
{
    public function index(Request $request)
    {   
        $detail = AduanDetail::all();
        $data = Aduan::orderBy('aduan_status','asc')
                    ->select('aduan.*','users.name')
                    ->leftJoin('users','users.id','=','aduan.pegawai_id')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('no_aduan','LIKE','%'.$request->keyword.'%')
                                ->orWhere('tanggal', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('invent/aduan.index',compact('data','detail'));
    }

    public function create()
    {
        $data = Inventaris::all();
        $user = User::all()
                ->where('id','!=','1');
        $no_aduan = $this->getNoAduan();
        return view('invent/aduan.add',compact('data','user','no_aduan'));
    }

    public function detail($id)
    {
       $aduan = Aduan::find($id);
       $detail = AduanDetail::where('aduan_id',$id)->get();
       return view('invent/aduan.detail',compact('aduan','detail'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'no_aduan' => 'required|unique:aduan',
            'tanggal' => 'required|date',
            'pegawai_id'=> 'required'
        ]);

        DB::beginTransaction(); // kegunaan untuk multiple insert (banyak aksi k database)
            $aduan =Aduan::create($request->all());
            $aduan_id = $aduan->id;
            for ($i = 0; $i < count($request->input('aduan_detail')); $i++){
                $data = [
                    'aduan_id' => $aduan_id,
                    'inventaris_id' => $request->aduan_detail[$i] ,
                    'keterangan' => $request->note[$i]
                ];
                AduanDetail::create($data);
            }
        DB::commit(); 

        return redirect('/invent/aduan/print/'.$aduan_id);

    }

    public function print($id)
    {
        $data = Aduan::where('id',$id)->first();
        $isi = AduanDetail::where('aduan_id',$id)

        ->get();

        $pejabat = Pejabat::all();

        $petugas = Petugas::where('id', '=', 1)->first();

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
        
        $pdf = PDF::loadview('invent/aduan.print',compact('data','isi','menyetujui','petugas','pejabat','mengetahui'));
        return $pdf->stream();
    }

   
    public function edit($id)
    {
        $data = Aduan::where('id',$id)->first();
        return view('invent/aduan.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $aduan = Aduan::find($id);
        for ($i = 0; $i < count($request->input('detail_id')); $i++){
            $detail_id = $request->detail_id[$i];
            AduanDetail::where('id',$detail_id)->update([
                'status' => $request->status[$i]
            ]);
        }
        $aduan->update(['aduan_status' => $request->aduan_status]);
        return redirect('/invent/aduan/detail/'.$id)->with('sukses','Barang sudah diperbaharui');
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
      $no_aduan = $first."/SPI/BBPOM/".date('m')."/".date('Y');
      return $no_aduan;
    }


}
