<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use App\User;
use App\Activitycode;
use App\Krocode;
use App\Detailcode;
use App\Komponencode;
use App\Subcode;
use App\Accountcode;
use App\Implementation;
use App\Implemen_detail;
use App\Loka;

class ImplementController extends Controller
{
    public function index(Request $request)
    {   
        $data = Implementation::orderBy('implementation.id','desc')
                    ->SelectRaw('implementation.*')
                    ->leftJoin('users','users.id','=','implementation.users_id')
                    ->leftJoin('krocode','krocode.id','=','implementation.krocode_id')
                    ->leftJoin('detailcode','detailcode.id','=','implementation.detailcode_id')
                    ->leftJoin('komponencode','komponencode.id','=','implementation.komponencode_id')
                    ->leftJoin('subcode','subcode.id','=','implementation.subcode_id')
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('users.name','LIKE','%'.$request->keyword.'%')
                                ->orWhere('users.no_pegawai', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('krocode.code', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('detailcode.code', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('komponencode.code', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('subcode.code', 'LIKE','%'.$request->keyword.'%')
                                ->orWhere('implementation.year', 'LIKE','%'.$request->keyword.'%');
                    })
                    ->paginate('10');
        return view('finance/implementation.index',compact('data'));
    }

    public function create()
    {
        $act = Activitycode::all();
        $kro = Krocode::all();
        $det = Detailcode::all();
        $kom = Komponencode::all();
        $sub = Subcode::all();
        $akun = Accountcode::all();
        $loka = Loka::all();
        return view('finance/implementation.create',compact('act','kro','det','kom','sub','akun','loka'));
    }
   
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'users_id'=> 'required',
            'activitycode_id'=> 'required',
            'month'=> 'required',
            'year'=> 'required',
            'krocode_id'=> 'required',
            'detailcode_id'=> 'required',
            'komponencode_id'=> 'required',
            'subcode_id'=> 'required'
        ]);

        DB::beginTransaction(); // kegunaan untuk multiple insert (banyak aksi k database)
            $implementation =Implementation::create($request->all());
            $implementation_id = $implementation->id;
            for ($i = 0; $i < count($request->input('accountcode_id')); $i++){
                $data = [
                    'implementation_id' => $implementation_id,
                    'accountcode_id'    => $request->accountcode_id[$i] ,
                    'loka_id'           => $request->loka_id[$i] ,
                    'volume'            => $request->volume[$i] ,
                    'price'             => $request->price[$i] ,
                    'total'             => $request->total[$i] ,
                    'sd'                => $request->sd[$i]
                ];
                Implemen_detail::create($data);
            }
        DB::commit(); 

        return redirect('/finance/implementation')->with('sukses','Data Berhasil Disimpan');

    }

    public function edit($id)
    {
        $act = Activitycode::all();
        $kro = Krocode::all();
        $det = Detailcode::all();
        $kom = Komponencode::all();
        $sub = Subcode::all();
        $akun = Accountcode::all();
        $loka = Loka::all();
        $data = Implementation::where('id',$id)->first();
        $detail = Implemen_detail::where('implementation_id',$id)->get();
        return view('finance/implementation.edit',compact('data','detail','act','kro','det','kom','sub','akun','loka'));
    }

    public function update(Request $request,$id)
    {
        // dd($request->all());

        $this->validate($request,[
            'activitycode_id'=> 'required',
            'month'=> 'required',
            'year'=> 'required',
            'krocode_id'=> 'required',
            'detailcode_id'=> 'required',
            'komponencode_id'=> 'required',
            'subcode_id'=> 'required'
        ]);

        DB::beginTransaction();
            for ($i = 0; $i < count($request->input('accountcode_id')); $i++){
                $data = [
                    'implementation_id' => $id,
                    'accountcode_id'    => $request->accountcode_id[$i] ,
                    'loka_id'           => $request->loka_id[$i] ,
                    'volume'            => $request->volume[$i] ,
                    'price'             => $request->price[$i] ,
                    'total'             => $request->total[$i] ,
                    'sd'                => $request->sd[$i]
                ];
                Implementation::where('id',$id)->update([
                    'month'=>$request->month, 
                    'year'=>$request->year
                ]);
                Implemen_detail::where('implementation_id',$id)
                            ->update($data);
            }
        DB::commit(); 

        return redirect('/finance/implementation')->with('sukses','Data Berhasil Diperbaharui');

    }


}
