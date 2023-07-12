<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventaris;
use App\User;
use App\Satuan;
use App\Pejabat;
use App\Labory;
use App\Broken;
use App\Entrystock;
use PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BrokenController extends Controller
{
    public function index(Request $request)
    {   
        $data = Broken::orderBy('id','desc')
                        ->select('broken.*','inventaris.nama_barang','labory.name')
                        ->leftJoin('inventaris','inventaris.id','=','broken.inventaris_id')
                        ->leftJoin('labory','labory.id','=','broken.labory_id')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('nomor','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('nama_barang', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('labory.name', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('invent/broken.index',compact('data'));
    }

    public function create()
    {
        $data = Inventaris::orderBy('nama_barang','asc')
                            ->whereraw('jenis_barang IN (3,8,21)')
                            ->get();
        $user = User::all()
                ->where('id','!=','1');
        $satuan = Satuan::all();
        $norusak = $this->getNoRusak();
        $lab    = Labory::all();
        // $tahu = Pejabat::selectraw('DISTINCT(jabatan_id), id, divisi_id, subdivisi_id, users_id, pjs')
        //                 -> whereraw('pjs is null and jabatan_id != 6')->Orderby('id','desc')->get();
        $tahu = User::where('status','PNS')->where('aktif','Y')->get();
        return view('invent/broken.create',compact('data','user','norusak','satuan','tahu','lab'));
    }

   
    public function store(Request $request)
    {
        $now = Carbon::now();
        $this->validate($request,[
            'nomor'         => 'required|unique:broken',
            'users_id'    => 'required',
            // 'pejabat_id'    => 'required',
            'inventaris_id' => 'required',
            'jumlah' => 'required',
            'file_foto' => 'mimes:jpg,png,jpeg|max:2048',
        ]);
        $rusak = Broken::create($request->all());
        $rusak_id = $rusak->id;

        if($request->hasFile('foto')){ // Kalau file ada
            $request->file('foto')
                        ->move('images/broken/'.$rusak_id,$request
                        ->file('foto')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $rusak->foto = $request->file('foto')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $rusak->save(); // save ke database
        }

        $stok = [
            'entry_date' => $now,
            'inventaris_id' => $request->inventaris_id,
            'stock' => $request->stock,
            'keluar' => $request->jumlah,
            'exp_date' => $now];
        Entrystock::create($stok);

        return redirect('/invent/broken/print/'.$rusak_id);
    }

    public function print($id)
    {
        $data = Broken::where('id',$id)->first();
        if ($data->mengetahui != null) {
            $mengetahui = User::where('id',$data->mengetahui)->first();
        } else {
            $tahu = Pejabat::where('id',$data->pejabat_id)->first();
            $mengetahui = User::where('id',$tahu->users_id)->first();
        }
        $pdf = PDF::loadview('invent/broken.print',compact('data','mengetahui'));
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
   
    public function edit($id)
    {
        $data = Broken::where('id',$id)->first();
        $barang = Inventaris::orderBy('nama_barang','asc')
                ->whereraw('jenis_barang IN (3,8,21)')
                ->get();
        $user = User::all()
        ->where('id','!=','1');
        $satuan = Satuan::all();
        $lab    = Labory::all();
        // $tahu = Pejabat::selectraw('DISTINCT(jabatan_id), id, divisi_id, subdivisi_id, users_id, pjs')
        //     -> whereraw('pjs is null and jabatan_id != 6')->Orderby('id','desc')->get();
        $tahu = User::where('status','PNS')->where('aktif','Y')->get();
        return view('invent/broken.edit',compact('data','barang','user','satuan','tahu','lab'));
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'jumlah' => 'required',
            'file_foto' => 'mimes:jpg,png,jpeg|max:2048'
        ]);

        $broken = Broken::find($id);
        $broken->update($request->all());

        if($request->hasFile('foto')){ // Kalau file ada
            $request->file('foto')
                        ->move('images/broken/'.$broken->id,$request
                        ->file('foto')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $broken->foto = $request->file('foto')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $broken->save(); // save ke database
        }
        return redirect('/invent/broken/')->with('sukses','Barang sudah diperbaharui');
    }


    function getNoRusak(){
      $nomor = Broken::orderBy('id','desc')->whereYear('tanggal',date('Y'))->get();
      $first = "001";
      if($nomor->count()>0){
        $first = $nomor->first()->id+1;
        if($first < 10){
            $first = "00".$first;
        }else if($first < 100){
            $first = "0".$first;
        }
      }
      $norusak = $first."/LPBR/BBPOM/".date('m')."/".date('Y');
      return $norusak;
    }


}
