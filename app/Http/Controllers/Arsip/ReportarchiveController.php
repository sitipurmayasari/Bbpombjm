<?php

namespace App\Http\Controllers\Arsip;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Archives;
use App\Mailclasification;
use App\Divisi;
use App\Mailsubgroup;
use App\Mailgroup;
use PDF;

class ReportarchiveController extends Controller
{

    public function index(Request $request)
    {
        $divisi = Divisi::where('id','!=','1')->get();
        return view('arsip/reportarchive.index',compact('divisi'));
    }

    public function cetak(Request $request)
    {
        if ($request->jenis=="1") {
            $data = Archives::orderBy('mailclasification.alias','asc')
                            ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                            ->when($request->divisi, function ($query) use ($request) {
                                $query->where('divisi_id',$request->divisi);
                             })
                            ->when($request->tahun, function ($query) use ($request) {
                                $query->whereYear('.date',$request->tahun);
                             })
                            ->get();
            $div = Divisi::where('id', $request->divisi)->first();
            return view('arsip/reportarchive.cetakone',compact('data','request','div'));

        }elseif($request->jenis=="2"){
            $data = Archives::orderBy('mailclasification.alias','asc')
                            ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                            ->when($request->divisi, function ($query) use ($request) {
                                $query->where('divisi_id',$request->divisi);
                            })
                            ->when($request->tahun, function ($query) use ($request) {
                                $query->whereYear('.date',$request->tahun);
                            })
                            ->get();
                $div = Divisi::where('id', $request->divisi)->first();
                return view('arsip/reportarchive.cetaktwo',compact('data','request','div'));            
        } else {
            dd($request->all());

        }            
    } 

}
