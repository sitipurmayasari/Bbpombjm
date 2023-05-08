<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Destination;
use App\Outstation;
use App\Subcode;
use App\Activitycode;
use App\Accountcode;
use App\Divisi;
use App\PPK;
use App\Budget;
use App\Outst_employee;
use App\Outst_destiny;
use App\Pejabat;
use App\Stbook;
use App\Stbook_sppd;
use PDF;
use DateTime;
use Carbon\Carbon;
use App\Pok_detail;
use Exception;
use LogActivity;


class OutstationController extends Controller
{

    public function index(Request $request)
    {
      $div =auth()->user()->divisi_id;
      if ($div == '1' || $div == '2') {
        $data = Outstation::orderBy('updated_at','desc')
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('number','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('purpose', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('st_date', 'LIKE','%'.$request->keyword.'%');
                            })
                        ->paginate(10);
      } else {
        $data = Outstation::orderBy('updated_at','desc')
                        ->where('divisi_id',$div)
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('number','LIKE','%'.$request->keyword.'%')
                                    ->orWhere('purpose', 'LIKE','%'.$request->keyword.'%')
                                    ->orWhere('st_date', 'LIKE','%'.$request->keyword.'%');
                            })
                        ->paginate(10);
      }
      
     
        return view('finance/outstation.index',compact('data'));
    }

    public function create()
    {
        $thn            = Carbon::now()->year;
        $ppk            = PPK::all();
        $budget         = Budget::OrderBy('id','desc')->get();
        $act            = Activitycode::all();
        $sub            = Subcode::all();
        $akun           = Accountcode::all();
        $div            = Divisi::all();
        $user           = User::where('id','!=','1')->get();
        $destination    = Destination::all();
        $pok            = Pok_detail::SelectRaw('pok_detail.*')
                                    ->leftjoin('pok','pok.id','=','pok_detail.pok_id')
                                    ->where('pok.year','=',$thn)
                                    ->WhereRaw("pok_id IN ((select id from pok where year = $thn and activitycode_id = 3  ORDER BY id DESC LIMIT 1),
                                    (select id from pok where year = $thn and activitycode_id = 2  ORDER BY id DESC LIMIT 1))")
                                    ->get();
        
        return view('finance/outstation.create',compact('user','destination','div','ppk', 'sub', 'akun','act','budget'
        ,'pok'));
    }
      public function store(Request $request)
      { 
        // dd($request->all());
        $this->validate($request,[
            'number' => 'required',
            'divisi_id' => 'required',
            'purpose'=> 'required',
            'ppk_id'=> 'required',
            'budget_id'=> 'required',
            'city_from'=> 'required',
            'type'=> 'required',
        ]);          
        DB::beginTransaction(); 
            $outstation = Outstation::create($request->all());
            $outstation_id = $outstation->id;
            for ($i = 0; $i < count($request->input('users_id')); $i++){
                $data = [
                    'outstation_id' => $outstation_id,
                    'users_id'      => $request->users_id[$i],
                    'no_sppd'       => $request->no_sppd[$i],
                ];
                Outst_employee::create($data);
            }
            
            for ($i = 0; $i < count($request->input('destination_id')); $i++){
              $tgl1 = new DateTime($request->go_date[$i]);
              $tgl2 = new DateTime($request->return_date[$i]);
              $daylong_1 = $tgl2->diff($tgl1)->days + 1;
              $request->merge(['daylong_1'=>$daylong_1]);
              
              $data = [
                  'outstation_id'   => $outstation_id,
                  'destination_id'  => $request->destination_id[$i],
                  'go_date'         =>$request->go_date[$i],
                  'return_date'     =>$request->return_date[$i],
                  'longday'         =>$daylong_1
              ];
              Outst_destiny::create($data);
            }

            DB::commit();

            LogActivity::addToLog('Simpan->Surat Tugas, nomor = '.$request->number);
  
          return redirect('/finance/outstation');  
      }

      public function printST($id)
      {
        $now = Budget::whereraw('code LIKE "D%"')->orderBy('id','desc')->first(); 
        $data = Outstation::where('id',$id)->first();
        $isian = Outst_employee::orderBy('id','asc')
                            ->where('outstation_id','=',$id)
                            ->get();        
        $jmlpeg  = Outst_employee::SelectRaw('count(*) as hitung')   
                                  ->where('outstation_id',$id)
                                  ->first(); 
        $cekkepala = Outst_employee::where('outstation_id',$id)
                                  ->whereraw("users_id = (SELECT users_id FROM pejabat WHERE jabatan_id = 6 and pjs IS NULL ORDER BY id DESC LIMIT 1)")
                                  ->orderby('id','desc')
                                  ->first();
        if ($cekkepala != null) {
          $menyetujui = Pejabat::where('jabatan_id', '=', 6)
                                ->whereRaw("pjs IS NULL")
                                ->orderby('id','desc')
                                ->first();
        } else {
          $menyetujui = Pejabat::where('jabatan_id', '=', 6)
                              ->whereRaw("(SELECT st_date FROM outstation WHERE id=$id) BETWEEN dari AND sampai")
                              ->orderby('id','desc')
                              ->first();
        }
        
        if ($jmlpeg->hitung > 8) {
          $pdf = PDF::loadview('finance/outstation.printSTbanyak',compact('data','isian','menyetujui'));
        }elseif ($jmlpeg->hitung > 2 && $jmlpeg->hitung <= 4 ){
          $pdf = PDF::loadview('finance/outstation.printstgantung',compact('data','isian','menyetujui','now'));
        // }elseif ($jmlpeg->hitung >= 4 && $jmlpeg->hitung <= 5 && $data->dasar == null){
        //   $pdf = PDF::loadview('finance/outstation.printstgantung',compact('data','isian','menyetujui','now'));
        }elseif ($jmlpeg->hitung > 4 && $jmlpeg->hitung <= 7){
          $pdf = PDF::loadview('finance/outstation.printstgantung2',compact('data','isian','menyetujui','now'));
        } else {
          $pdf = PDF::loadview('finance/outstation.printST',compact('data','isian','menyetujui','now'));
        }
        return $pdf->stream();
        
      }

      public function printSTKop($id)
      {
        $data = Outstation::where('id',$id)->first();
        $isian = Outst_employee::orderBy('id','asc')
                            ->where('outstation_id','=',$id)
                            ->get();
        $menyetujui = Pejabat::where('jabatan_id', '=', 6)
                            ->whereRaw("pjs IS NULL || pjs != 'Plh.'")
                            ->orderby('id','desc')
                            ->first();
        $jmlpeg  = Outst_employee::SelectRaw('count(*) as hitung')   
                            ->where('outstation_id',$id)
                            ->first(); 

        // $phpWord = new \PhpOffice\PhpWord\PhpWord();
        if ($jmlpeg->hitung > 7) {
          $pdf = PDF::loadview('finance/outstation.printSTKopbanyak',compact('data','isian','menyetujui'));
        }elseif ($jmlpeg->hitung > 2 && $jmlpeg->hitung <= 4 ){
          $pdf = PDF::loadview('finance/outstation.printstkopgantung',compact('data','isian','menyetujui'));
        }elseif ($jmlpeg->hitung > 4 && $jmlpeg->hitung <= 7){
          $pdf = PDF::loadview('finance/outstation.printstkopgantung2',compact('data','isian','menyetujui'));
        } else {
          $pdf = PDF::loadview('finance/outstation.printSTKop',compact('data','isian','menyetujui'));
        }
        return $pdf->stream();

        // return view('finance/outstation.printSTKop',compact('data','isian','menyetujui'));

        
      }


      public function printSppd($id)
      {
        $data       = Outstation::where('id',$id)->first();
        $isian      = Outst_employee::orderBy('id','asc')
                            ->where('outstation_id','=',$id)
                            ->get();
        $menyetujui = Pejabat::where('jabatan_id', '=', 11)
                            ->whereRaw("(SELECT st_date FROM outstation WHERE id=$id) BETWEEN dari AND sampai")
                            ->first();
        $destinys   = Outst_destiny::orderBy('id','asc')
                            ->where('outstation_id','=',$id)
                            ->get();      
        $hit       = Outst_destiny::selectRaw('count(*) as jum')
                            ->where('outstation_id','=',$id)
                            ->first();
        $desti1   = Outst_destiny::orderBy('id','asc')
                      ->where('outstation_id','=',$id)
                      ->first();  
        $desti2   = Outst_destiny::orderBy('id','desc')
                      ->where('outstation_id','=',$id)
                      ->first();   

        if ($desti1->go_date==$desti2->go_date) {
            $lama = Outst_destiny::selectRaw('longday as hitung')
                  ->where('outstation_id','=',$id)
                  ->first();
        } elseif($desti1->return_date==$desti2->go_date){
          $lama = Outst_destiny::selectRaw('((sum(longday)) - 1) as hitung')
                  ->where('outstation_id','=',$id)
                  ->first();
        } else {
            $lama = Outst_destiny::selectRaw('sum(longday) as hitung')
                  ->where('outstation_id','=',$id)
                  ->first();
        }
            
        if ($data->type=='DL') {
          $pdf = PDF::loadview('finance/outstation.inside',compact('data','isian','destinys','lama'));
        } elseif ($data->type=='DL8') {
            $pdf = PDF::loadview('finance/outstation.inside2',compact('data','isian','destinys','lama'));
        } else {
          $pdf = PDF::loadview('finance/outstation.sppdnewN',compact('data','isian','menyetujui','destinys','lama'));
        }
        return $pdf->stream();
      }

      public function printSppdD($id)
      {
        $data       = Outstation::where('id',$id)->first();
        $isian      = Outst_employee::orderBy('id','asc')
                            ->where('outstation_id','=',$id)
                            ->get();
        $menyetujui = Pejabat::where('jabatan_id', '=', 11)
                            ->whereRaw("(SELECT st_date FROM outstation WHERE id=$id) BETWEEN dari AND sampai")
                            ->first();
        $destinys   = Outst_destiny::orderBy('id','asc')
                            ->where('outstation_id','=',$id)
                            ->get();      
        $hit       = Outst_destiny::selectRaw('count(*) as jum')
                            ->where('outstation_id','=',$id)
                            ->first();
        $desti1   = Outst_destiny::orderBy('id','asc')
                      ->where('outstation_id','=',$id)
                      ->first();  
        $desti2   = Outst_destiny::orderBy('id','desc')
                      ->where('outstation_id','=',$id)
                      ->first();   

        if ($desti1->go_date==$desti2->go_date) {
            $lama = Outst_destiny::selectRaw('longday as hitung')
                  ->where('outstation_id','=',$id)
                  ->first();
        } elseif($desti1->return_date==$desti2->go_date){
          $lama = Outst_destiny::selectRaw('((sum(longday)) - 1) as hitung')
                  ->where('outstation_id','=',$id)
                  ->first();
        } else {
            $lama = Outst_destiny::selectRaw('sum(longday) as hitung')
                  ->where('outstation_id','=',$id)
                  ->first();
        }
            
          $pdf = PDF::loadview('finance/outstation.sppdnewN',compact('data','isian','menyetujui','destinys','lama'));
        return $pdf->stream();
      }

      public function printSppdB($id)
      {
        $data       = Outstation::where('id',$id)->first();
        $isian      = Outst_employee::orderBy('id','asc')
                            ->where('outstation_id','=',$id)
                            ->get();
        $menyetujui = Pejabat::where('jabatan_id', '=', 11)
                            ->whereRaw("(SELECT st_date FROM outstation WHERE id=$id) BETWEEN dari AND sampai")
                            ->first();
        $destinys   = Outst_destiny::orderBy('id','asc')
                            ->where('outstation_id','=',$id)
                            ->get();      
        $hit       = Outst_destiny::selectRaw('count(*) as jum')
                            ->where('outstation_id','=',$id)
                            ->first();
        $desti1   = Outst_destiny::orderBy('id','asc')
                      ->where('outstation_id','=',$id)
                      ->first();  
        $desti2   = Outst_destiny::orderBy('id','desc')
                      ->where('outstation_id','=',$id)
                      ->first();   

        if ($desti1->go_date==$desti2->go_date) {
            $lama = Outst_destiny::selectRaw('longday as hitung')
                  ->where('outstation_id','=',$id)
                  ->first();
        } elseif($desti1->return_date==$desti2->go_date){
          $lama = Outst_destiny::selectRaw('((sum(longday)) - 1) as hitung')
                  ->where('outstation_id','=',$id)
                  ->first();
        } else {
            $lama = Outst_destiny::selectRaw('sum(longday) as hitung')
                  ->where('outstation_id','=',$id)
                  ->first();
        }

        $pdf = PDF::loadview('finance/outstation.sppdnewB',compact('data','isian','menyetujui','destinys','lama'));
        return $pdf->stream();
      }

      public function edit($id)
      {
         
          $thn            = Carbon::now()->year;
          $ppk            = PPK::all();
          $budget         = Budget::OrderBy('id','desc')->get();
          $act            = Activitycode::all();
          $sub            = Subcode::all();
          $akun           = Accountcode::all();
          $div            = Divisi::all();
          $user           = User::where('id','!=','1')->get();
          $destination    = Destination::all();
          $data           = Outstation::where('id',$id)->first();
          $petugas        = Outst_employee::where('outstation_id',$id)->get();
          $kota           = Outst_destiny::where('outstation_id',$id)->get();
          $pok            = Pok_detail::SelectRaw('pok_detail.*')
                          ->leftjoin('pok','pok.id','=','pok_detail.pok_id')
                          ->where('pok.year','=',$thn)
                          ->get();
          $hitpeserta     = Outst_employee::SelectRaw('COUNT(id) AS jumpes')->where('outstation_id',$id)->first();
          $sppd           = Stbook_sppd::leftjoin('stbook','stbook.id','=','stbook_sppd.stbook_id')
                            ->where('stbook.stbook_number',$data->number)->get();
          return view('finance/outstation.edit',compact('data','petugas','kota','ppk','budget','act','sub',
                      'akun','div','user','destination','pok','hitpeserta','sppd'
          ));
      }

      public function update(Request $request, $id)
      {
        $data = Outstation::find($id);
        $data->touch();
        LogActivity::addToLog('Ubah->Surat Tugas, nomor = '.$data->number);

        $outstation_id = $id;
        DB::beginTransaction(); 
          //---------------outstation----------------------
            $data = Outstation::find($id);
            $data->update($request->all());

            if($request->hasFile('file')){ // Kalau file ada
              $request->file('file')
                          ->move('images/ST/'.$outstation_id,$request
                          ->file('file')
                          ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
              $data->file = $request->file('file')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
              $data->save(); // save ke database
            }

          //---------------outst_employee----------------------
           for ($i = 0; $i < count($request->input('users_id')); $i++){
                $data = [
                    'outstation_id' => $id,
                    'users_id'      => $request->users_id[$i],
                    'no_sppd'       => $request->no_sppd[$i]
                ];
                Outst_employee::updateOrCreate([
                  'id'   => $request->outemp_id[$i],
                ],$data);
          }

          //---------------outst_destiny----------------------

          for ($i = 0; $i < count($request->input('destination_id')); $i++){
            $tgl1 = new DateTime($request->go_date[$i]);
            $tgl2 = new DateTime($request->return_date[$i]);
            $daylong_1 = $tgl2->diff($tgl1)->days + 1;
            $request->merge(['daylong_1'=>$daylong_1]);
            
            $data = [
                'outstation_id'   => $id,
                'destination_id'  => $request->destination_id[$i],
                'go_date'         => $request->go_date[$i],
                'return_date'     => $request->return_date[$i],
                'longday'         => $daylong_1
            ];
            Outst_destiny::updateOrCreate([
              'id'   => $request->outdes_id[$i],
            ],$data);
          }  

        DB::commit();

        return redirect('/finance/outstation')->with('sukses','Data Diperbaharui');
      }


      public function delete($id)
    {
        $data = Outstation::find($id);
        LogActivity::addToLog('Hapus->Surat Tugas, nomor = '.$data->number);
        $data->delete();
        return redirect('/finance/outstation')->with('sukses','Data Terhapus');
    }

    public function deletepeg($id)
    {
        $data = Outst_employee::find($id);

        $out = $data->outstation_id;

        $data->delete();
        return redirect('finance/outstation/edit/'.$out)->with('sukses','Pegawai Terhapus');
    }

    public function deletetujuan($id)
    {
        $data = Outst_destiny::find($id);

        $out = $data->outstation_id;

        $data->delete();
        return redirect('finance/outstation/edit/'.$out)->with('sukses','Pegawai Terhapus');
    }


    public function getnomorst(Request $request)
    {
        $nost = Stbook::WhereRaw('stbook_number NOT IN ("select number from outstation")')
                        ->where('divisi_id',$request->divisi_id)
                        ->orderBy('id','desc')
                        ->get();
        return response()->json([ 
          'success' => true,
          'nost' => $nost
        ],200);
    }
    
    public function getnomorsppd(Request $request)
    {
        $nosppd = Stbook_sppd::SelectRaw('stbook_sppd.*')
                              ->LeftJoin('stbook','stbook.id','=','stbook_sppd.stbook_id')
                              ->WhereRaw('stbook_sppd.nomor_sppd NOT IN ("select no_sppd from outst_employee")')
                              ->where('stbook.stbook_number',$request->stbook_number)
                              ->get();
        return response()->json([ 
            'success' => true,
            'nosppd' => $nosppd
          ],200);
    }

}
