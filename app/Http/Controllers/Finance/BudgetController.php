<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Budget;

class BudgetController extends Controller
{
    public function index(Request $request)
    {
        $data = Budget::orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('code','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('finance/budget.index',compact('data'));
    }

    public function create()
    {
        return view('finance/budget.create');
    }

    public function store(Request $request)
    {
        
        Budget::create($request->all());
        return redirect('/finance/budget')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Budget::where('id',$id)->first();
        return view('finance/budget.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Budget::find($id);
        $data->update($request->all());
        return redirect('/finance/budget')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Budget::find($id);
        $petugas->delete();
        return redirect('/finance/budget')->with('sukses','Data Terhapus');
    }
}
