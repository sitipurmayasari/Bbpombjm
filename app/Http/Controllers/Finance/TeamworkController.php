<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teamleader;
use App\User;

class TeamworkController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('id','!=','1')->where('aktif','Y')->where('status','PNS')->orderby('name','asc')->get();
        $data = Teamleader::orderBy('id','desc')
                        ->selectraw('teamleader.*')
                        ->leftjoin('users','users.id','teamleader.users_id')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('users.name','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('detail', 'LIKE','%'.$request->keyword.'%');
                            })
                        ->paginate('10');
        return view('finance/teamwork.index',compact('data','user'));
    }

    public function store(Request $request)
    {
        
        Teamleader::create($request->all());
        return redirect('/finance/teamwork')->with('sukses','Data Tersimpan');
    }
   
    public function edit($id)
    {
        $user = User::where('id','!=','1')->where('aktif','Y')->where('status','PNS')->orderby('name','asc')->get();
        $data = Teamleader::where('id',$id)->first();
        return view('finance/teamwork.edit',compact('data','user'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Teamleader::find($id);
        $data->update($request->all());
        return redirect('/finance/teamwork')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Teamleader::find($id);
        $petugas->delete();
        return redirect('/finance/teamwork')->with('sukses','Data Terhapus');
    }
}
