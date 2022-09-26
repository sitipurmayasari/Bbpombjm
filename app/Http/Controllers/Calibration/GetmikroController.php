<?php

namespace App\Http\Controllers\Calibration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use LogActivity;
use App\User;
use App\Bakteri; 
use App\GetBakteri;


class GetmikroController extends Controller
{
    public function index(Request $request)
    {
        $data = GetBakteri::orderBy('id','desc')
                ->paginate('10');
        return view('calibration/getmikro.index',compact('data'));
    }

    public function create()
    {

        $bakteri = Bakteri::all();
        $peg = User::where('subdivisi_id','4')->where('aktif','Y')->get();

        return view('calibration/getmikro.create',compact('bakteri','peg'));
    }

    public function store(Request $request)
    {
        $data = GetBakteri::create($request->all());

        LogActivity::addToLog('Simpan-> Pengambilan Bakteri, id = '.$data->id);
        return redirect('/calibration/getmikro')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $bakteri = Bakteri::all();
        $peg = User::where('subdivisi_id','4')->where('aktif','Y')->get();
        $data = GetBakteri::where('id',$id)->first();
        return view('calibration/getmikro.edit',compact('data','bakteri','peg'));
    }

   
    public function update(Request $request, $id)
    {
        $data = GetBakteri::find($id);
        $data->update($request->all());
        LogActivity::addToLog('Ubah-> Pengambilan Bakteri, id = '.$id);
        return redirect('/calibration/getmikro')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = GetBakteri::find($id);

        LogActivity::addToLog('Hapus-> Pengambilan Bakteri, id = '.$data->id);

        $data->delete();

        return redirect('/calibration/getmikro')->with('sukses','Data Terhapus');
    }
}
