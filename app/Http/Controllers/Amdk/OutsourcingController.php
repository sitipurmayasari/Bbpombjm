<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Divisi;
use App\Jabatan;
use App\User;
use App\Golongan;
use Illuminate\Support\Str;
use App\Jabasn;


class OutsourcingController extends Controller
{
    public function index(Request $request)
    {
        $data = User::orderBy('id','desc')
                ->where('id','!=','1')
                ->where('jabatan_id','=','10')
                ->when($request->keyword, function ($query) use ($request) {
                $query->where('no_pegawai','LIKE','%'.$request->keyword.'%')
                        ->orWhere('name', 'LIKE','%'.$request->keyword.'%')
                        ->where('jabatan_id','=','10');
                })
                ->paginate('10');

        return view('amdk/outsourcing.index',compact('data'));
    }
   

    public function create()
    {
        $gol = Golongan::all();
        $jabatan = Jabatan::all();
        $divisi = Divisi::all();
        $user = User::all();
        $jabasn = Jabasn::all();

        return view('amdk/outsourcing.create',compact('user','jabatan','gol','jabasn'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'no_pegawai' => 'required|unique:users',
            'email' => 'required|unique:users'
        ]);
        
        $request->merge([
            'password' =>  bcrypt("12345678"),
            'remember_token' => Str::random(60)
        ]);

        $user=User::create($request->all());
        return redirect('/amdk/outsourcing')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $data = User::where('id',$id)->first();
        $gol = Golongan::all();
        $jabatan = Jabatan::all();
        $jabasn = Jabasn::all();
        return view('amdk/outsourcing.edit',compact('data','jabatan','gol','jabasn'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return redirect('/amdk/outsourcing')->with('sukses','Data Diperbaharui');
    }
}
