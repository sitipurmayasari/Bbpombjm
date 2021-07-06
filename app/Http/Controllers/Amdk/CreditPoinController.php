<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Credit_poin;


class CreditPoinController extends Controller
{

    public function index(Request $request)
    {
        $data = Credit_poin::orderBy('id','desc')
                ->select('credit_poin.*','users.name')
                ->leftJoin('users','users.id','=','credit_poin.users_id')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('dari','LIKE','%'.$request->keyword.'%')
                            ->orWhere('sampai', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('name', 'LIKE','%'.$request->keyword.'%');
                    })
                ->where('credit_poin.status','=','R')
                ->paginate('10');
        return view('amdk/credit_poin.index',compact('data'));
    }

    public function create()
    {
        $user = User::all();
        return view('amdk/credit_poin.create',compact('user'));
    }


    public function store(Request $request)
    {
       
        $this->validate($request,[
            'users_id' => 'required',
            'dari' => 'required',
            'sampai' => 'required',
            'poin' => 'required'
        ]);

        Credit_poin::create($request->all());

        return redirect('/amdk/credit_poin')->with('sukses','Data Tersimpan');
    }

    public function edit($id)
    {
        $user = User::all();
        $data = Credit_poin::where('id',$id)->first();
        return view('amdk/credit_poin.edit',compact('data','user'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'dari' => 'required',
            'sampai' => 'required',
            'poin' => 'required'
        ]);
        
        $data = Credit_poin::find($id);
        $data->update($request->all());
        return redirect('/amdk/credit_poin')->with('sukses','Data Diperbaharui');
    }

    
    public function delete($id)
    {
        $data = Credit_poin::find($id);
        $data->delete();
        return redirect('/amdk/credit_poin')->with('sukses','Data Terhapus');
    }
    

}
