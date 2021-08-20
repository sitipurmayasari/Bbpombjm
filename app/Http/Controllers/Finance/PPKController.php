<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PPK;
use App\User;

class PPKController extends Controller
{
    public function index(Request $request)
    {
        $user = User::all()
        ->where('id','!=','1');

        $data = PPK::orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('code','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('jabatan', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('finance/ppk.index',compact('data','user'));
    }

    public function store(Request $request)
    {
        
        PPK::create($request->all());
        return redirect('/finance/ppk')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $user = User::all()
        ->where('id','!=','1');
        $data = PPK::where('id',$id)->first();
        return view('finance/ppk.edit',compact('data','user'));
    }

   
    public function update(Request $request, $id)
    {
        $data = PPK::find($id);
        $data->update($request->all());
        return redirect('/finance/ppk')->with('sukses','Data Diperbaharui');
    }
}
