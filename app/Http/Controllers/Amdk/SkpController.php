<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Setup_ak;
use App\Pejabat;

class SkpController extends Controller
{

    public function index(Request $request)
    {
        $peg =auth()->user()->id;
        $data = Setup_ak::OrderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('unsur','LIKE','%'.$request->keyword.'%')
                                ->orWhere('sub_unsur', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('uraian', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('amdk/skp.index',compact('data'));
    }

    public function create()
    {
        $tahu = Pejabat::selectraw('DISTINCT(jabatan_id), id, divisi_id, subdivisi_id, users_id, pjs')
                                -> whereraw('pjs is null and jabatan_id != 6')->Orderby('id','desc')->get();
        return view('amdk/skp.create',compact('tahu'));
    }

    public function store(Request $request)
    {
        $user_id = $request->users_id;

        $this->validate($request,[
            'unsur'     => 'required',
            'sub_unsur' => 'required',
            'kode_ak'   => 'required',
            'uraian'    => 'required',
            'hasil'     => 'required'
        ]);

        return redirect('/amdk/skp')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $data = Setup_ak::where('id',$id)->first();
        $sub = Setup_ak::orderBy('sub_unsur','asc')
                        ->SelectRaw('unsur, sub_unsur')
                        ->where('unsur',$data->unsur)
                        ->groupby('sub_unsur')
                        ->get();
        return view('amdk/skp.edit',compact('data','sub'));
    }


    public function update(Request $request, $id)
    {
        $data = Setup_ak::find($id);
        $data->update($request->all());
        return redirect('/amdk/skp')->with('sukses','Data Diperbaharui');

    }

    
    public function delete($id)
    {
        $data = Setup_ak::find($id);
        $data->delete();
        return redirect('/amdk/skp')->with('sukses','Data Terhapus');
    }

    public function getunsur(Request $request)
    {
        $data = Setup_ak::orderBy('sub_unsur','asc')
                        ->SelectRaw('unsur, sub_unsur')
                        ->where('unsur',$request->unsur)
                        ->groupby('sub_unsur')
                        ->get();
        return response()->json([ 
            'success' => true,
            'data' => $data
        ],200);
    }



}
