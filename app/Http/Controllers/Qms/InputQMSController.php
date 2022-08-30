<?php

namespace App\Http\Controllers\Qms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Qms;
use App\Folder;

class InputQMSController extends Controller
{

    public function index(Request $request)
    {
        $data = Qms::orderBy('names','asc')
                        ->Selectraw('qms.*')
                        ->Leftjoin('folder','folder.id','qms.folder_id')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('names','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('folder.name', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('qms/inputqms.index',compact('data'));
    }

    public function create()
    {
        $folder = Folder::all();
        return view('qms/inputqms.create',compact('folder'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'file' => 'mimes:pdf|max:10240'
        ]);

        $dokument = Qms::create($request->all());
          if($request->hasFile('file')){ // Kalau file ada
            $request->file('file')
                        ->move('images/qms/'.$dokument->names.'/qms',$request
                        ->file('file')
                        ->getClientOriginalName()); 
            $dokument->file = $request->file('file')->getClientOriginalName(); 
            $dokument->save(); 
        }
        return redirect('/qms/inputqms')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $folder = Folder::all();
        $data = Qms::where('id',$id)->first();
        return view('qms/inputqms.edit',compact('data','folder'));
    }


    public function update(Request $request, $id)
    {
        $data = Qms::find($id);
        $data->touch();
        $data->update($request->all());

        if($request->hasFile('file')){ // Kalau file ada
            $request->file('file')
                        ->move('images/qms/'.$dokument->names.'/qms',$request
                        ->file('file')
                        ->getClientOriginalName()); 
            $data->upload = $request->file('file')->getClientOriginalName(); 
            $data->save(); 
        }

        return redirect('/qms/inputqms')->with('sukses','Data Diperbaharui');

    }

    
    public function delete($id)
    {
        $data = Qms::find($id);
        $data->Delete();
        return redirect('/qms/inputqms')->with('sukses','Data Terhapus');
    }

    public function getfolder(Request $request)
    {
        $data = Folder::orderBy('id','asc')->where('type',$request->type)->get();
        return response()->json([ 'success' => true,'data' => $data],200);
    }


}
