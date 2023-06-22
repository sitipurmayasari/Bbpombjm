<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Linkkulihanku;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        $data = Linkkulihanku::orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('name','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('aktif', 'LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('finance/link.index',compact('data'));
    }

    public function create()
    {
        return view('finance/link.create');
    }

    public function store(Request $request)
    {
        
        Linkkulihanku::create($request->all());
        return redirect('/finance/link')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Linkkulihanku::where('id',$id)->first();
        return view('finance/link.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Linkkulihanku::find($id);
        $data->update($request->all());
        return redirect('/finance/link')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Linkkulihanku::find($id);
        $data->delete();
        return redirect('/finance/link')->with('sukses','Data Terhapus');
    }
}
