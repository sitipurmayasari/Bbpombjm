<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agenda;
use App\Agenda_kategori;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $data = Agenda::orderBy('id','desc')
                ->select('agenda.*','agenda_kategori.nama')
                ->leftJoin('agenda_kategori','agenda_kategori.id','=','agenda.agenda_kategori_id')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('titles','LIKE','%'.$request->keyword.'%')
                            ->orWhere('detail', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('date_from', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('date_to', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('amdk/agenda.index',compact('data'));
    }

    public function create()
    {
        $kategori = Agenda_kategori::All();
        return view('amdk/agenda.create',compact('kategori'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'agenda_kategori_id' => 'required',
            'titles' => 'required',
            'detail' => 'required',
            'date_from' => 'required',
            'date_to' => 'required'
        ]);
        Agenda::create($request->all());
        return redirect('/amdk/agenda')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $kategori = Agenda_kategori::All();
        $data = Agenda::where('id',$id)->first();
        return view('amdk/agenda.edit',compact('data','kategori'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Agenda::find($id);
        $data->update($request->all());
        return redirect('/amdk/agenda')->with('sukses','Data Diperbaharui');
    }

    public function delete($id)
    {
        $data = Agenda::find($id);
        $data->delete();
        return redirect('/amdk/agenda')->with('sukses','Data Terhapus');

    }
}
