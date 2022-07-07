<?php

namespace App\Http\Controllers\Qms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Qms;

class MakroController extends Controller
{

    public function index(Request $request)
    {
        $data = Qms::orderBy('id','desc')
                        ->where('type','Makro')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('names','LIKE','%'.$request->keyword.'%');
                        })
                        ->paginate('10');
        return view('qms/mikro.index',compact('data'));
    }

}
