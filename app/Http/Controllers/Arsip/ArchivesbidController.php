<?php

namespace App\Http\Controllers\Arsip;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Naskah;

class ArchivesbidController extends Controller
{

    public function index(Request $request)
    {
        $data = Naskah::OrderBy('id','desc')
                ->when($request->keyword, function ($query) use ($request) {
                $query->where('bentuk','LIKE','%'.$request->keyword.'%');
                })
                ->paginate('10');
        return view('arsip/archivesbid.index',compact('data'));
    }

    public function edit($id)
    {
        $data = Naskah::where('id',$id)->first();
        return view('arsip/archivesbid.edit',compact('data'));
    }


    public function update(Request $request, $id)
    {
        $data = Naskah::find($id);
        $data->update($request->all());

        return redirect('/arsip/archivesbid')->with('sukses','Data Diperbaharui');

    }
    
    public function delete($id)
    {
        $data = Naskah::find($id);
        $data->forceDelete();
        return redirect('/arsip/archivesbid')->with('sukses','Data Terhapus');
    }

}
