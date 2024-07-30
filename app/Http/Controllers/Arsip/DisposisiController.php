<?php

namespace App\Http\Controllers\Arsip;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Divisi;
use App\Disposisi;
use PDF;
use LogActivity;


class DisposisiController extends Controller
{

    public function index(Request $request)
    {
        $data = Disposisi::orderBy('id','desc')
                                ->when($request->keyword, function ($query) use ($request) {
                                    $query->Where('no_surat','LIKE','%'.$request->keyword.'%')
                                        ->orwhere('pengirim','LIKE','%'.$request->keyword.'%')
                                        ->orWhere('tgl_surat', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('hal', 'LIKE','%'.$request->keyword.'%');
                                })
                                ->paginate('10');
        return view('arsip/disposisi.index',compact('data'));
    }

    public function create()
    {
        $div = Divisi::all();
        $nodis = $this->getNoDispo();
        return view('arsip/disposisi.create',compact('div','nodis'));
    }

    public function store(Request $request)
    {
        $data = Disposisi::create($request->all());
        if($request->hasFile('fileDispo')){ // Kalau file ada
            $request->file('fileDispo')
                        ->move('images/arsiparis/disposisi/'.$data->id,$request
                        ->file('fileDispo')
                        ->getClientOriginalName()); 
            $data->fileDispo = $request->file('fileDispo')->getClientOriginalName(); 
            $data->save(); // save ke database
        }

        LogActivity::addToLog('Simpan->Disposisi nomor disposisi = '.$request->no_agenda); 
        return redirect('/arsip/disposisi')->with('sukses','Data Tersimpan');
    }
   
   
    public function edit($id)
    {
        $div = Divisi::all();
        $data = Disposisi::where('id',$id)->first();
        return view('arsip/disposisi.edit',compact('data','div'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Disposisi::find($id);
        $data->update($request->all());
        if($request->hasFile('fileDispo')){
            $request->file('fileDispo')
                        ->move('images/arsiparis/disposisi/'.$data->id,$request
                        ->file('fileDispo')
                        ->getClientOriginalName()); 
            $data->fileDispo = $request->file('fileDispo')->getClientOriginalName(); 
            $data->save(); // save ke database
        }
        LogActivity::addToLog('Ubah->Disposisi nomor disposisi = '.$request->no_agenda); 
        return redirect('/arsip/disposisi')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $subdivisi = Disposisi::find($id);
        $subdivisi->delete();
        return redirect('/arsip/disposisi')->with('sukses','Data Terhapus');

    }

    function getNoDispo(){
        $tahun = date('Y');

        $nomor = Disposisi::orderBy('id','desc')->whereYear('tanggal',date('Y'))->get();

        if ($tahun == '2023') {
            $counting = Disposisi::SelectRaw('id AS jum')->orderBy('id','desc')->first();
        } else {
            $counting = Disposisi::SelectRaw("COUNT(*)AS jum ")->whereYear('tanggal',date('Y'))->first();
        }
        
       
        $first = "0001";
        if($nomor->count()>0){
          $first = $counting->jum+1;
            if($first < 10){
              $first = "000".$first;
            }else if($first < 100){
              $first = "00".$first;
            }else if($first < 1000){
                $first = "0".$first;
            }
        }
        $nosurat = $first."/ Tahun ".date('Y');
        return $nosurat;
      }


    public function rekap()
    {
        $div = Divisi::all();
        return view('arsip/disposisi.rekap',compact('div'));
    }

    public function cetak(Request $request)
    {
            $data = Disposisi::orderBy('id','asc')
                    ->whereYear('tanggal',$request->daftartahun)
                            ->when($request->piltgl, function ($query) use ($request) {
                                if($request->piltgl==1){
                                    $query->whereYear('tanggal',$request->daftartahun);
                                    $query->whereMonth('tanggal',$request->daftarbulan); 
                                }
                            })
                            ->when($request->piltgl, function ($query) use ($request) {
                                if($request->piltgl==2){
                                    $query->WhereRaw('tanggal between "'.$request->awal.'" AND "'.$request->akhir.'"');
                                }
                             })
                            ->get();
            // return view('arsip/disposisi.cetak',compact('data','request'));
            $pdf = PDF::loadview('arsip/disposisi.cetak',compact('data','request'));
            return $pdf->stream();
    }
  

}
