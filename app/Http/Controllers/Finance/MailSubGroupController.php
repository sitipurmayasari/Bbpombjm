<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mailgroup;
use App\Mailsubgroup;

class MailsubgroupController extends Controller
{
    public function index(Request $request)
    {
        $data = Mailsubgroup::orderBy('id','desc')
                            ->select('mailsubgroup.*','mailgroup.code as group')
                            ->leftJoin('mailgroup','mailgroup.id','=','mailsubgroup.mailgroup_id')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('mailgroup.code','LIKE','%'.$request->keyword.'%')
                                        ->orWhere('mailsubgroup.names', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('mailsubgroup.code', 'LIKE','%'.$request->keyword.'%');
                            })
                            ->paginate('10');
        return view('finance/mailsubgroup.index',compact('data'));
    }

    public function create()
    {
        $group = Mailgroup::all();
        return view('finance/mailsubgroup.create',compact('group'));
    }

    public function store(Request $request)
    {
        $group = Mailgroup::where('id',$request->mailgroup_id)->first();

        $alias = $group->code.".".$request->code;
        $request->merge([ 'alias' => $alias]);

        Mailsubgroup::create($request->all());
        return redirect('/finance/mailsubgroup')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $group = Mailgroup::all();
        $data = Mailsubgroup::where('id',$id)->first();
        return view('finance/mailsubgroup.edit',compact('data','group'));
    }

   
    public function update(Request $request, $id)
    {
        $group = Mailgroup::where('id',$request->mailgroup_id)->first();

        $alias = $group->code.".".$request->code;
        $request->merge([ 'alias' => $alias]);


        $data = Mailsubgroup::find($id);
        $data->update($request->all());
        return redirect('/finance/mailsubgroup')->with('sukses','Data Diperbaharui');
    }
}
