<?php

namespace App\Http\Controllers\Qms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Folder;

class FolderQMSController extends Controller
{

    public function index(Request $request)
    {
        $data = Folder::orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('name','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('type', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('qms/folderqms.index',compact('data'));
    }

    public function create()
    {
        return view('qms/folderqms.create');
    }

    public function store(Request $request)
    {
        Folder::create($request->all());
        return redirect('/qms/folderqms')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $data = Folder::where('id',$id)->first();
        return view('qms/folderqms.edit',compact('data'));
    }


    public function update(Request $request, $id)
    {
        $data = Folder::find($id);
        $data->touch();
        $data->update($request->all());

        return redirect('/qms/folderqms')->with('sukses','Data Diperbaharui');

    }

    
    public function delete($id)
    {
        $data = Folder::find($id);
        $data->Delete();
        return redirect('/qms/folderqms')->with('sukses','Data Terhapus');
    }




}
