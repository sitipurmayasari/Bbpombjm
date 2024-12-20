<?php

namespace App\Http\Controllers\Qms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Qms;
use App\Folder;

class MakroController extends Controller
{

    public function index(Request $request)
    {
        $data = Folder::where('type','!=','1')->get();;
        return view('qms/makro.index',compact('data'));
    }

    public function folder(Request $request ,$id)
    {
        $folder = Folder::where('id',$id)->first();
        $data = Qms::orderBy('names','asc')
                    ->Selectraw('qms.*')
                    ->Leftjoin('folder','folder.id','qms.folder_id')
                    ->where('folder_id',$id)
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('names','LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('qms/makro.folder',compact('data','folder'));
    }


}
