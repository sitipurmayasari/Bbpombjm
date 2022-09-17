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
                ->where('status','aktif')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('uraian','LIKE','%'.$request->keyword.'%')
                        ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                        ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                })
                ->paginate('10');
        $datainac = Archives::orderBy('archives.id','desc')
                    ->Selectraw('archives.*')
                    ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                    ->where('status','inaktif')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('uraian','LIKE','%'.$request->keyword.'%')
                            ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        $dataper = Archives::orderBy('archives.id','desc')
                    ->Selectraw('archives.*')
                    ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                    ->where('status','permanen')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('uraian','LIKE','%'.$request->keyword.'%')
                            ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');

        $datakan = Archives::orderBy('archives.id','desc')
                    ->Selectraw('archives.*')
                    ->leftjoin('mailclasification','mailclasification.id','archives.mailclasification_id')
                    ->where('status','akanmusnah')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('uraian','LIKE','%'.$request->keyword.'%')
                            ->orWhere('mailclasification.alias', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        $datadel = Archives::onlyTrashed()->paginate('10');
        return view('arsip/archiveslist.index',compact('data','datainac','datadel','klas','dataper','datakan'));
    }

}
