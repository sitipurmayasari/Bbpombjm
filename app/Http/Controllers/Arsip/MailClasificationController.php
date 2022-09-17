<?php

namespace  App\Http\Controllers\Arsip;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mailsubgroup;
use App\Mailclasification;

class MailclasificationController extends Controller
{
    public function index(Request $request)
    {
        $data = MailClasification::orderBy('id','desc')
                            ->select('mailclasification.*','mailsubgroup.code as subg', 'mailgroup.code as group')
                            ->leftJoin('mailsubgroup','mailsubgroup.id','=','mailclasification.mailsubgroup_id')
                            ->leftJoin('mailgroup','mailgroup.id','=','mailsubgroup.mailgroup_id')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('mailclasification.alias','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('mailgroup.code', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('mailsubgroup.code', 'LIKE','%'.$request->keyword.'%');
                            })
                            ->paginate('10');
        return view('arsip/mailclasification.index',compact('data'));
    }

    public function create()
    {
        $subg = Mailsubgroup::all();
        return view('arsip/mailclasification.create',compact('subg'));
    }

    public function store(Request $request)
    {

        $group = Mailsubgroup::where('id',$request->mailsubgroup_id)->first();

        if ($request->code == "00") {
            $alias = $group->alias;
        } else {
            $alias = $group->alias.".".$request->code;
        }
        $request->merge([ 'alias' => $alias]);

        
        Mailclasification::create($request->all());
        return redirect('/arsip/mailclasification')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $subg = Mailsubgroup::all();
        $data = Mailclasification::where('id',$id)->first();
        return view('arsip/mailclasification.edit',compact('data','subg'));
    }

   
    public function update(Request $request, $id)
    {

        $group = Mailsubgroup::where('id',$request->mailsubgroup_id)->first();

        if ($request->code == "00") {
            $alias = $group->alias;
        } else {
            $alias = $group->alias.".".$request->code;
        }
        $request->merge([ 'alias' => $alias]);
        
        $data = Mailclasification::find($id);
        $data->update($request->all());
        return redirect('/arsip/mailclasification')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Mailclasification::find($id);
        $petugas->delete();
        return redirect('/arsip/mailclasification')->with('sukses','Data Terhapus');
    }

    public function getData(Request $request)
    {
        $id = $request->kelas;

        $data = Mailclasification::where('id',$id)->first();
        return response()->json([ 'success' => true,'data' => $data],200);
    }

}
