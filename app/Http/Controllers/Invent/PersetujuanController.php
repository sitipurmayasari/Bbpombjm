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

class PersetujuanController extends Controller
{
    public function index(Request $request)
    {   
        $detail = PengajuanDetail::all();
        $data = Pengajuan::orderBy('id','desc')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('no_ajuan','LIKE','%'.$request->keyword.'%')
                                ->orWhere('tgl_ajuan', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('kelompok', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('invent/persetujuan.index',compact('data','detail'));
    }

    public function edit($id)
    {
       $ajuan = Pengajuan::find($id);
       $detail = pengajuanDetail::where('pengajuan_id',$id)->get();
       return view('invent/persetujuan.edit',compact('ajuan','detail'));
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
        return redirect('invent/persetujuan')->with('sukses','Barang sudah diperbaharui');
    }


}
