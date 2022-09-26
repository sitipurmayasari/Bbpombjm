<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\LogActivity;

class LogActController extends Controller
{
    public function index(Request $request)
    {
        $data = LogActivity::orderBy('id','desc')
                            ->SelectRaw('log_activities.*')
                            ->leftjoin('users','users.id','log_activities.users_id')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('subject','LIKE','%'.$request->keyword.'%')
                                        ->orWhere('users.name', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('ip', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('kelompok', 'LIKE','%'.$request->keyword.'%');
                                })
                                ->paginate('10');
        return view('amdk/logact.index',compact('data'));
    }
}
