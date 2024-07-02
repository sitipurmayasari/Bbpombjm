<?php

namespace App\Http\Controllers\Invent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Driver;
use LogActivity;

class DriverController extends Controller
{

    public function index(Request $request)
    {
        $data = Driver::orderBy('id','desc')
                ->paginate('10');
        return view('invent/drivers.index',compact('data'));
    }

    public function store(Request $request)
    {
        
        $data= Driver::create($request->all());
        LogActivity::addToLog('Simpan->Driver, id = '.$data->id);

        return redirect('/invent/drivers')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $jenjang = Pendidikan::all();
        $data = Driver::where('id',$id)->first();
        return view('invent/drivers.edit',compact('data','jenjang'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Driver::find($id);
        $data->update($request->all());
        LogActivity::addToLog('Update->Driver, id = '.$id);

        return redirect('/invent/drivers')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $data = Driver::find($id);
        LogActivity::addToLog('Hapus->Driver, '.$data->drivers);
        $data->delete();
        return redirect('/invent/drivers')->with('sukses','Data Terhapus');
    }

}
