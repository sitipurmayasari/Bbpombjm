<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Labory;
use App\User;
use App\Planlab;
use App\Planlab_detail;
use App\Satuan;
use PDF;
use LogActivity;

class PlanLabController extends Controller
{
    public function index(Request $request)
    {   
        $peg =auth()->user()->id;
        $data = Planlab::selectraw('planlab.*')
                    ->orderBy('planlab.id','desc')
                    ->Leftjoin('labory','labory.id','planlab.labory_id')
                    ->Leftjoin('users','users.id','planlab.users_id')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('no_ajuan','LIKE','%'.$request->keyword.'%')
                                ->orWhere('tgl_ajuan', 'LIKE','%'.$request->keyword.'%')
                                >orWhere('users.name', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('labory.name', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('invent/planlab.index',compact('data'));
    }

    public function create()
    {
        $user = User::all()
                ->where('id','!=','1');
        $satuan = Satuan::all();
        $lab = Labory::all();
        $no_ajuan = $this->getNoAjuan();
        return view('invent/planlab.create',compact('user','no_ajuan','satuan','lab'));
    }
   
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'names'=> 'required',
            'katalog'=> 'required',
            'kemasan'=> 'required',
            // 'file_foto' => 'mimes:jpg,png,jpeg|max:2048',
        ]);

        DB::beginTransaction(); // kegunaan untuk multiple insert (banyak aksi k database)
            $plan =Planlab::create($request->all());
            $planlab_id = $plan->id;

          
            for ($i = 0; $i < count($request->input('names')); $i++){
                $data = [
                    'planlab_id' => $planlab_id,
                    'names' => $request->names[$i],
                    'satuan_id' => $request->satuan_id[$i],
                    'jumlah' => $request->jumlah[$i],
                    'katalog' => $request->katalog[$i],
                    'kemasan' => $request->kemasan[$i],
                    'file_foto' => $request->file_foto[$i]
                ];
                $detail = Planlab_detail::create($data);

                // dd($request->file_foto[$i]);
                // return;
                
                // if($request->file_foto[$i]){ // Kalau file ada
                   $request->file_foto[$i]->move(
                       'images/planlab/'.$detail->id,
                       $request->file_foto[$i]->getClientOriginalName()
                    ); // pindah file user manual k inventaris folder id file

                    $detail->file_foto = $request->file_foto[$i]->getClientOriginalName(); // update isi kolum file user dengan origin gambar
                    $detail->save(); // save ke database
                // }
                
            }
        DB::commit(); 

        LogActivity::addToLog('Simpan->Perencanaan Pengadaan Laboratorium nomor:'.$plan->no_ajuan);

        return redirect('/invent/planlab')->with('sukses','Data Tersimpan');
        // return redirect('/invent/planlab/print/'.$pengajuan_id);

    }

    public function print($id)
    {
        $data = Planlab::where('id',$id)->first();
        $detail = Planlab_detail::where('planlab_id',$id)->get();
        
        $pdf = PDF::loadview('invent/planlab.print',compact('data','detail'));
        return $pdf->stream();
    }

    public function edit($id)
    {
        $data = Planlab::where('id',$id)->first();
        $detail = Planlab_detail::where('planlab_id',$id)->get();
        $satuan = Satuan::all();
        $lab = Labory::all();

        LogActivity::addToLog('Ubah->Perencanaan Pengadaan Laboratorium nomor:'.$data->no_ajuan);

        return view('invent/planlab.edit',compact('data','detail','satuan','lab'));
    }
   
    public function update(Request $request, $id)
    {
        $data = Planlab::find($id);
        $data->touch();

        DB::beginTransaction(); 
          //---------------planlab----------------------
            $data = Planlab::find($id);
            $data->update($request->all());

          //---------------planlab_detail----------------------
           for ($i = 0; $i < count($request->input('names')); $i++){
                $data = [
                    'planlab_id'    => $id,
                    'names'         => $request->names[$i],
                    'satuan_id'     => $request->satuan_id[$i],
                    'jumlah'        => $request->jumlah[$i],
                    'katalog'       => $request->katalog[$i],
                    'kemasan'       => $request->kemasan[$i]
                ];
                Planlab_detail::updateOrCreate([
                  'id'   => $request->plandet_id[$i],
                ],$data);
          }

        DB::commit();
        return redirect('/invent/planlab/')->with('sukses','Barang sudah diperbaharui');
    }


    function getNoAjuan(){
      $ajuan = Planlab::orderBy('id','desc')->whereYear('tgl_ajuan',date('Y'))->get(); 
      $first = "001";
      if($ajuan->count()>0){
        $first = $ajuan->first()->id+1;
        if($first < 10){
            $first = "00".$first;
        }else if($first < 100){
            $first = "0".$first;
        }
      }
      $no_ajuan = $first."/PPL/BBPOM/".date('m')."/".date('Y');
      return $no_ajuan;
    }


}
