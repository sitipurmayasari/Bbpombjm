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
                ->paginate('10');
        return view('amdk/logact.index',compact('data'));
    }
}
