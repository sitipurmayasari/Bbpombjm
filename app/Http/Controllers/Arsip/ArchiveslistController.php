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
use App\Naskah;

class ArchiveslistController extends Controller
{

    public function index(Request $request)
    {
        $klas = Mailgroup::all();
        $data = Archives::orderBy('archives.id','desc')
                ->Selectraw('archives.*')
                ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                ->whereRaw('CURDATE() BETWEEN DATE(archives.date) 
                and DATE_ADD(DATE(archives.date),INTERVAL mailclasification.actived YEAR)')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('uraian','LIKE','%'.$request->keyword.'%')
                        ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                        ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                })
                ->paginate('10');
        $datainac = Archives::orderBy('archives.id','desc')
                    ->Selectraw('archives.*')
                    ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                    ->whereRaw('curdate() > DATE_ADD(archives.date,INTERVAL mailclasification.actived YEAR)')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('uraian','LIKE','%'.$request->keyword.'%')
                            ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        $datadel = Archives::onlyTrashed()->paginate('10');
        return view('arsip/archiveslist.index',compact('data','datainac','datadel','klas'));
    }

}
