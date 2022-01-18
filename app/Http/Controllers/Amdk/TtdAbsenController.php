<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Divisi;
use App\Subdivisi;
use App\User;



class TtdAbsenController extends Controller
{
    public function index(Request $request)
    {
        $divisi = Divisi::all();
        return view('amdk/ttdabsen.index',compact('divisi'));
    }

    public function store(Request $request)
    {
        $data =User::orderBy('jabatan.urutan','asc')
                ->selectRaw('users.no_pegawai, users.name')
                ->leftJoin('jabatan','jabatan.id','=','users.jabatan_id')
                ->leftJoin('divisi','divisi.id','=','users.divisi_id')
                ->where ('users.id','!=','1')
                ->where('users.aktif','Y')
                ->when($request->status != '1', function ($query) use ($request) {
                    $query->where('users.status','=',$request->status);
                    })
                ->when($request->divisi, function ($query) use ($request) {
                        $query->where('divisi.id','=',$request->divisi);
                        })
        ->get();

        $pdf = PDF::loadview('amdk/ttdabsen.cetakan',compact('data','request'));
        return $pdf->stream();
        
    }
   

}
