<?php

namespace App\Http\Controllers\Calibration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Parameter;
use App\Catatan; 
use App\User;
use PDF;


class CatatanController extends Controller
{
    public function index(Request $request)
    {
        $data = Catatan::orderBy('id','desc')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('nama_sampel','LIKE','%'.$request->keyword.'%')
                                ->orWhere('kode_sampel', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('komuditi', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('calibration/catatan.index',compact('data'));
    }

    public function create()
    {
        $parameter = Parameter::all();
        return view('calibration/catatan.create',compact('parameter'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama_sampel' => 'required',
            'kode_sampel' => 'required',
            'komuditi' => 'required',
            'foto' => 'mimes:jpg,png,jpeg|max:2048'
        ]);

        $data=Catatan::create($request->all());

        if($request->hasFile('foto')){ // Kalau file ada
            $request->file('foto')
                        ->move('images/catatanuji/'.$data->id,$request
                        ->file('foto')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $data->foto = $request->file('foto')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $data->save(); // save ke database
        }

        
        return redirect('/calibration/catatan')->with('sukses','Data Tersimpan');
    }

    public function printcatatan($id)
    {
        $data = Catatan::find($id);
        $tahubaru = User::where('id',$data->user_id)->first();
        $pdf = PDF::loadview('calibration/catatan.printcatatan',compact('data','tahubaru'));
        return $pdf->stream();

    }

    // public function edit($id)
    // {
    //     $data = Bakteri::where('id',$id)->first();
    //     $detail = BakteriDetail::where('bakteri_id',$id)->get();
    //     $media = Media::all();
    //     return view('calibration/catatan.edit',compact('data','detail','media'));
    // }


    // public function update(Request $request, $id)
    // {
    //     $data = Bakteri::find($id);
    //     $data->touch();
    //     LogActivity::addToLog('Ubah->Daftar Bakteri, nama bakteri = '.$data->name);

    //     DB::beginTransaction(); 
    //       $data = Bakteri::find($id);
    //       $data->update($request->all());

    //     for ($i = 0; $i < count($request->input('media_id')); $i++){
        
    //       $data = [
    //         'bakteri_id' => $id,
    //         'media_id'   => $request->media_id[$i]
    //       ];
    //       BakteriDetail::updateOrCreate([
    //         'id'   => $request->detail_id[$i],
    //       ],$data);
    //     }  

    //   DB::commit();
    //     return redirect('/calibration/catatan')->with('sukses','Data Diperbaharui');
    // }

    // public function delete($id)
    // {
    //     $data = Bakteri::find($id);
    //     $detail = BakteriDetail::where ('bakteri_id',$id)->delete();
    //     LogActivity::addToLog('Ubah->Hapus Kontrol Mikrobiologi, kontrol : '.$data->status);
    //     $data->delete();
    //     return redirect('/calibration/catatan')->with('sukses','Data Terhapus');
    // }

}
