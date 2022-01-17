<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Excel;
use PDF;
use Carbon\Carbon;
use App\User;
use App\Programcode;
use App\Activitycode;
use App\Krocode;
use App\Detailcode;
use App\Komponencode;
use App\Subcode;
use App\Accountcode;
use App\Loka;
use App\Pok;
use App\Pok_detail;

use App\Imports\PokImport;


class RevisionController extends Controller
{
    public function index(Request $request)
    {   
        $data = Pok::orderBy('pok.id','desc')
                            ->SelectRaw('pok.*')
                            ->leftJoin('users','users.id','=','pok.users_id')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('users.name','LIKE','%'.$request->keyword.'%')
                                        ->orWhere('users.no_pegawai', 'LIKE','%'.$request->keyword.'%')
                                        ->orWhere('pok.year', 'LIKE','%'.$request->keyword.'%');
                            })
                            ->paginate('10');
        return view('finance/revision.index',compact('data'));
    }

    public function create()
    {
        $kro = Krocode::all();
        $ro = Detailcode::all();
        $komp = Komponencode::all();
        $sub = Subcode::all();
        $acc = Accountcode::all();
        $act = Activitycode::all();
        return view('finance/revision.create',compact('act','kro','ro','komp','sub','acc'));
    }

    public function impor(Request $request)
      {
          $this->validate($request, [
              'diimpor' => 'required|mimes:csv,xls,xlsx',
              'activitycode_id' => 'required',
              'year' => 'required',
              'users_id'=> 'required',
              'jenis'=> 'required',
              'revisi'=> 'required'
          ]);

          $file = $request->diimpor;
          $nama_file = $file->getClientOriginalName();
          
  
          $file->move('excel',$nama_file);

          
          $asal_pok = $request->jenis."(".$request->revisi.")";

          $request->merge([ 'asal_pok' => $asal_pok]);
        //   // import data
        DB::beginTransaction();
            $pok =POK::create($request->all());
            $pok_id = $pok->id;

            // Excel::import(new PokImport($pok_id), urlStorage().'/excel/'.$nama_file);
            Excel::import(new PokImport($pok_id), public_path('/excel/'.$nama_file));
        
        DB::commit();
  
          return redirect('/finance/revision');
   
      }

      public function store(Request $request)
      {
        // dd($request->all());
        $this->validate($request, [
            'activitycode_id' => 'required',
            'year' => 'required',
            'users_id'=> 'required',
            'jenis'=> 'required',
            'revisi'=> 'required'
        ]);

            $asal_pok = $request->jenis."(".$request->revisi.")";

            $request->merge([ 'asal_pok' => $asal_pok]);
  
          DB::beginTransaction();
              $pok =POK::create($request->all());
              $pok_id = $pok->id;
              for ($i = 0; $i < count($request->input('subcode_id')); $i++){
                $sub = Subcode::where('subcode.id',$request->subcode_id[$i])
                        ->SelectRaw('subcode.id AS sub_id, krocode.id AS kro_id, detailcode.id AS det_id, komponencode.id AS kom_id')
                        ->LeftJoin('komponencode','komponencode.id','=','subcode.komponencode_id')
                        ->LeftJoin('detailcode','detailcode.id','=','komponencode.detailcode_id')
                        ->LeftJoin('krocode','krocode.id','=','detailcode.krocode_id')
                        ->first();
                  $data = [
                      'pok_id'          => $pok_id,
                      'krocode_id'      => $sub->kro_id,
                      'detailcode_id'   => $sub->det_id,
                      'komponencode_id' => $sub->kom_id,
                      'subcode_id'      => $request->subcode_id[$i],
                      'accountcode_id'  => $request->accountcode_id[$i],
                      'loka_id'         => $request->loka_id[$i],
                      'price'           => $request->price[$i],
                      'volume'          => $request->volume[$i],
                      'total'           => $request->total[$i],
                      'sd'              => $request->sd[$i]
                  ];
                  if ($request->total[$i]!=0) {
                    Pok_detail::create($data);
                  }
                 
              }
          DB::commit(); 
  
          return redirect('/finance/revision');
  
      }


    public function view($id)
    {
        $data = Pok::where('id',$id)->first();
        
        $alokasi = Pok_detail::SelectRaw('SUM(total) AS jum')
                                    ->Where('pok_id',$id)
                                    ->first();

        $detail = Pok_detail::where('pok_id',$id)->get();

        $prog = Pok::SelectRaw('DISTINCT programcode_id, SUM(total) AS jum')
                            ->LeftJoin('pok_detail','pok.id','=','pok_detail.pok_id')
                            ->LeftJoin('activitycode','activitycode.id','=','pok.activitycode_id')
                            ->Where('pok.id',$id)
                            ->GroupBy('programcode_id')
                            ->get();

        $activ = Pok::SelectRaw('DISTINCT activitycode_id, SUM(total) AS jum')
                            ->LeftJoin('pok_detail','pok.id','=','pok_detail.pok_id')
                            ->Where('pok.id',$id)
                            ->GroupBy('activitycode_id')
                            ->get();
        $add = Pok_detail::SelectRaw('DISTINCT krocode_id, SUM(total) AS jum')
                            ->Where('pok_id',$id)
                            ->GroupBy('krocode_id')
                            ->get();

        $deta = Pok_detail::SelectRaw('DISTINCT detailcode_id, SUM(total) AS jum')
                            ->Where('pok_id',$id)
                            ->GroupBy('detailcode_id')
                            ->get();

        $komp = Pok_detail::SelectRaw('DISTINCT komponencode_id, SUM(total) AS jum')
                            ->Where('pok_id',$id)
                            ->GroupBy('komponencode_id')
                            ->get();
                            
        $akun = Pok_detail::SelectRaw('DISTINCT accountcode_id,subcode_id, SUM(total) AS jum')
                            ->Where('pok_id',$id)
                            ->GroupBy('accountcode_id')
                            ->GroupBy('subcode_id')
                            ->get();       
                            
        if ($data->jenis=='A') {
            return view('finance/revision.view',compact('data','detail','alokasi','prog','activ','add','deta','komp','akun'));
        } else {
            return view('finance/revision.viewrev',compact('data','detail','alokasi','prog','activ','add','deta','komp','akun'));
        }
        
    }

    public function getPokDetail(Request $request)
    {
        $data = Pok_detail::where('id',$request->id)
                    ->first();
        return response()->json([ 
            'success' => true,
            'data' => $data],200
        );
    }




}
