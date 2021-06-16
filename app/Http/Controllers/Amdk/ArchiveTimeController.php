<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Archive_time;

class ArchiveTimeController extends Controller
{

    public function index(Request $request)
    {

        $data = Archive_time::orderBy('nama','asc')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('nama','LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('amdk/archive_time.index',compact('data'));
    }


    public function create()
    {
        return view('amdk/archive_time.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama'       => 'required|unique:archive_time',
            'masa_aktif' => 'required',
            'masa_pasif' => 'required'
        ]);
        Archive_time::create($request->all());
        return redirect('/amdk/archive_time')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $data = Archive_time::where('id',$id)->first();
        return view('amdk/archive_time.edit',compact('data'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,['nama' => 'required']);
        $archive_time = Archive_time::find($id);
        $archive_time->update($request->all());
        return redirect('/amdk/archive_time')->with('sukses','Data Diperbaharui');
    }

    
    public function delete($id)
    {
        $data = Archive_time::find($id);
        $data->delete();
        return redirect('/amdk/archive_time')->with('sukses','Data Terhapus');
    }




}
