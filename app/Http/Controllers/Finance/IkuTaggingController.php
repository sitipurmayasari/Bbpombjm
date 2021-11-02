<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Target;
use App\Indicator;
use App\Pagu;
use App\PaguDetail;
use App\Subcode;
use Excel;
use App\Imports\PaguImport;


class IkuTaggingController extends Controller
{
    public function index(Request $request)
    {
        $data = Pagu::orderBy('id','desc')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('name','LIKE','%'.$request->keyword.'%');
                            })
                            ->paginate('10');
        return view('finance/ikutagging.index',compact('data'));
    }

    public function create()
    {
        $target = Target::all();
        return view('finance/ikutagging.create',compact('target'));
    }

    public function impor(Request $request)
    {
        $this->validate($request, [
            'diimpor' => 'required|mimes:csv,xls,xlsx',
            'year' => 'required',
            'month' => 'required',
            'users_id'=> 'required'
        ]);

        $file = $request->diimpor;
        $nama_file = $file->getClientOriginalName();
        
        $file->move('excel',$nama_file);

        $nama = "Pagu".$request->month.$request->year;
        $request->merge([ 'name' => $nama]);

        // import data
        DB::beginTransaction();
          $pagu =Pagu::create($request->all());
          $pagu_id = $pagu->id;

        //   Excel::import(new PaguImport($pagu_id), urlStorage().'/excel/'.$nama_file);
          Excel::import(new PaguImport($pagu_id), public_path('/excel/'.$nama_file));
      
        DB::commit();

        return redirect('/finance/ikutagging/taging/'.$pagu_id);
 
    }

    public function taging($id)
    {   
        $iku    = Indicator::all();
        $pagu   = Pagu::where('id',$id)->first();
        $data   = PaguDetail::SelectRaw('DISTINCT subcode_id,SUM(paguakhir) AS pagusub, SUM(realisasi) AS realisasisub')
                            ->Where('pagu_id',$id)
                            ->GroupBy('accountcode_id')
                            ->orderBy('subcode_id','asc')
                            ->get();


        $sub    = Subcode::all();
        return view('finance/ikutagging.taging',compact('pagu','data','iku','sub'));
    }

    public function store()
    {
        $target = Target::all();
        return view('finance/ikutagging.taging',compact('target'));
    }
   
    public function edit($id)
    {
        $target = Target::all();
        $data = Indicator::where('id',$id)->first();
        return view('finance/ikutagging.edit',compact('data','target'));
    }

   
    public function update(Request $request, $id)
    {
        $data = Indicator::find($id);
        $data->update($request->all());
        return redirect('/finance/ikutagging')->with('sukses','Data Diperbaharui');
    }

   
    public function delete($id)
    {
        $petugas = Indicator::find($id);
        $petugas->delete();
        return redirect('/finance/ikutagging')->with('sukses','Data Terhapus');
    }
}
