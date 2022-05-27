<?php

namespace  App\Http\Controllers\Amdk;

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
                                $query->where('mailclasification.code','LIKE','%'.$request->keyword.'%')
                                ->orWhere('mailgroup.code', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('mailclasification.names', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('mailsubgroup.code', 'LIKE','%'.$request->keyword.'%');
                            })
                            ->paginate('10');
        return view('amdk/mailclasification.index',compact('data'));
    }

    public function create()
    {
        $subg = Mailsubgroup::all();
        return view('amdk/mailclasification.create',compact('subg'));
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
        return redirect('/amdk/mailclasification')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $subg = Mailsubgroup::all();
        $data = Mailclasification::where('id',$id)->first();
        return view('amdk/mailclasification.edit',compact('data','subg'));
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
        return redirect('/amdk/mailclasification')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Mailclasification::find($id);
        $petugas->delete();
        return redirect('/amdk/mailclasification')->with('sukses','Data Terhapus');
    }
}
