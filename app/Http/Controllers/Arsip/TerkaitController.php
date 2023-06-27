<?php

namespace App\Http\Controllers\Arsip;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Terkait;

class TerkaitController extends Controller
{
    public function index(Request $request)
    {
        $data = Terkait::orderBy('id','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('name','LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('arsip/terkait.index',compact('data'));
    }

    public function create()
    {
        return view('arsip/terkait.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'icon' => 'mimes:jpg,png,jpeg|max:100',
        ]);

        $terkait =Terkait::create($request->all());

        if($request->hasFile('icon')){ // Kalau file ada
            $request->file('icon')
                        ->move('images/terkait/',$request
                        ->file('icon')
                        ->getClientOriginalName()); 
            $terkait->icon = $request->file('icon')->getClientOriginalName();
            $terkait->save();
        }
        return redirect('/arsip/terkait')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $data = Terkait::where('id',$id)->first();
        return view('arsip/terkait.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {

        // $this->validate($request,[
        //     'icon2' => 'mimes:jpg,png,jpeg|max:100',
        // ]);

        $data = Terkait::find($id);
        $data->update($request->all());

        if($request->hasFile('icon2')){ // Kalau file ada
            $request->file('icon2')
                        ->move('images/terkait/',$request
                        ->file('icon2')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $data->icon = $request->file('icon2')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $data->save(); // save ke database
        }

        return redirect('/arsip/terkait')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Terkait::find($id);
        $data->delete();
        return redirect('/arsip/terkait')->with('sukses','Data Terhapus');
    }
}
