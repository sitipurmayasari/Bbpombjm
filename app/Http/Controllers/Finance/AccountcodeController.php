<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Accountcode;

class AccountcodeController extends Controller
{
    public function index(Request $request)
    {
        $data = Accountcode::orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('code','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('finance/accountcode.index',compact('data'));
    }

    public function create()
    {
        return view('finance/accountcode.create');
    }

    public function store(Request $request)
    {
        
        Accountcode::create($request->all());
        return redirect('/finance/accountcode')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Accountcode::where('id',$id)->first();
        return view('finance/accountcode.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Accountcode::find($id);
        $data->update($request->all());
        return redirect('/finance/accountcode')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Accountcode::find($id);
        $petugas->delete();
        return redirect('/finance/accountcode')->with('sukses','Data Terhapus');
    }
}
