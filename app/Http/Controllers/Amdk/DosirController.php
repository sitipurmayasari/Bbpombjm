<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Dosir;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DosirController extends Controller
{

    public function index(Request $request)
    {
        $peg =auth()->user()->id;
        $user = User::all();
        $data = Dosir::orderBy('id','desc')
                ->where('users_id','=',$peg)
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('nama','LIKE','%'.$request->keyword.'%')
                            ->orWhere('created_at', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('amdk/dosir.index',compact('data','user'));
    }

    public function rekapdosir(Request $request)
    {

        $user = User::all();
        $data = Dosir::orderBy('id','desc')
                ->select('dosir.*','users.name')
                ->leftJoin('users','users.id','=','dosir.users_id')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('nama','LIKE','%'.$request->keyword.'%')
                            ->orWhere('name', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('dosir.created_at', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('amdk/dosir.rekapdosir',compact('data','user'));
    }

    public function create()
    {
        $user = User::all();
        return view('amdk/dosir.create',compact('user'));
    }

    public function store(Request $request)
    {
        $user_id = $request->users_id;

        $this->validate($request,[
            'users_id' => 'required',
            'nama' => 'required',
            'file' => 'required'
        ]);

        $dokument = Dosir::create($request->all());
        if($request->hasFile('file')){ // Kalau file ada
            $request->file('file')
                        ->move('images/pegawai/'.$dokument->users_id.'/dosir',$request
                        ->file('file')
                        ->getClientOriginalName()); 
            $dokument->file = $request->file('file')->getClientOriginalName(); 
            $dokument->save(); 
        }

        return redirect('/amdk/dosir')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $data = Dosir::where('id',$id)->first();
        return view('amdk/dosir.edit',compact('data'));
    }


    public function update(Request $request, $id)
    {
        $user_id = $request->users_id;
        $data = Dosir::find($id);
        $data->update($request->all());
        if($request->hasFile('file')){ // Kalau file ada
            $request->file('file')
                        ->move('images/pegawai/'.$data->users_id.'/dosir',$request
                        ->file('file')
                        ->getClientOriginalName()); 
            $data->upload = $request->file('file')->getClientOriginalName(); 
            $data->save(); 
        }


        return redirect('/amdk/dosir')->with('sukses','Data Diperbaharui');

    }

    
    public function delete($id)
    {
        $data = Dosir::find($id);
        $data->delete();
        return redirect('/amdk/dosir')->with('sukses','Data Terhapus');
    }




}
