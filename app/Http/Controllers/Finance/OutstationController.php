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
use PDF;
use DateTime;
use Carbon\Carbon;
use App\Pok_detail;

class OutstationController extends Controller
{

    public function index(Request $request)
    {
        $data = Outstation::orderBy('id','desc')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('number','LIKE','%'.$request->keyword.'%')
                            ->orWhere('purpose', 'LIKE','%'.$request->keyword.'%')
                            ->orWhere('st_date', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate(10);
        return view('finance/outstation.index',compact('data'));
    }

    public function create()
    {
        $thn            = Carbon::now()->year;
        $ppk            = PPK::all();
        $budget         = Budget::all();
        $act            = Activitycode::all();
        $sub            = Subcode::all();
        $akun           = Accountcode::all();
        $div            = Divisi::all();
        $user           = User::where('id','!=','1')->get();
        $destination    = Destination::all();
        $pok            = Pok_detail::SelectRaw('pok_detail.*')
                                    ->leftjoin('pok','pok.id','=','pok_detail.pok_id')
                                    ->where('pok.year','=',$thn)
                                    ->get();
        
        return view('finance/outstation.create',compact('user','destination','div','ppk', 'sub', 'akun','act','budget','pok'
      ));
    }

    function getnost(Request $request){

        $sppd = Outstation::orderBy('id','desc')->whereYear('created_at',date('Y'))->get(); 
        $bidang = Divisi::select('lokasi')->where('id',$request->divisi_id)->first();
        $bulan = $request->date;
        $first = "0001";
        if($sppd->count()>0){
          $first = $sppd->first()->id+1;
            if($first < 10){
              $first = "000".$first;
            }else if($first < 100){
              $first = "00".$first;
            }else if($first < 1000){
            $first = "0".$first;
            }
        }
        $no_sppd = "RT.02.01.".$bidang->lokasi.".".date('m').".".date('y').".".$first;

        return response()->json([ 
            'success' => true,
            'no_sppd' => $no_sppd],200
        );
    }

    function getnosppd($id){

      $sppd = Outst_employee::orderBy('id','desc')->whereYear('created_at',date('Y'))->get(); 
      $bidang = Divisi::select('kode_sppd')->where('id',$id)->first();
      $first = "0001";
      if($sppd->count()>0){
        $first = $sppd->first()->id+1;
          if($first < 10){
            $first = "000".$first;
          }else if($first < 100){
            $first = "00".$first;
          }else if($first < 1000){
          $first = "0".$first;
          }
      }
      $no_sppd = $first."/".$bidang->kode_sppd."/SPPD/BBPOM"."/".date('Y');

      return $no_sppd;
  }

      public function store(Request $request)
      { 
        // dd($request->all());
        $this->validate($request,[
            'number' => 'required|unique:outstation',
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
               
                $nomorsppd = $this->getnosppd($request->divisi_id);
                $data = [
                    'outstation_id' => $outstation_id,
                    'users_id'      => $request->users_id[$i],
                    'no_sppd'        =>$nomorsppd
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
                  'return_date'     =>$request->go_date[$i],
                  'longday'         =>$daylong_1
              ];
              Outst_destiny::create($data);
            }

            DB::commit();
  
          return redirect('/finance/outstation');
  
      }
  


      public function printST($id)
      {
        $data = Outstation::where('id',$id)->first();
        $isian = Outst_employee::orderBy('id','asc')
                            ->where('outstation_id','=',$id)
                            ->get();
        $menyetujui = Pejabat::where('jabatan_id', '=', 6)
                            ->whereRaw("(SELECT st_date FROM outstation WHERE id=$id) BETWEEN dari AND sampai")
                            ->first();
        $pdf = PDF::loadview('finance/outstation.printST',compact('data','isian','menyetujui'));
        return $pdf->stream();
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
        $lama       = Outst_destiny::selectRaw('sum(longday) as hitung')
                            ->where('outstation_id','=',$id)
                            ->first();
        $hit       = Outst_destiny::selectRaw('count(*) as jum')
                            ->where('outstation_id','=',$id)
                            ->first();
        
        if ($data->type=='DL') {

          $pdf = PDF::loadview('finance/outstation.inside',compact('data','isian','destinys'));

        } else {

          if ($hit->jum==3) {
            $pdf = PDF::loadview('finance/outstation.printSppd3',compact('data','isian','menyetujui','destinys','lama'));
          }else{
            $pdf = PDF::loadview('finance/outstation.printSppd',compact('data','isian','menyetujui','destinys','lama'));
          }

        }
        return $pdf->stream();
      }


      public function edit($id)
      {
          $thn            = Carbon::now()->year;
          $ppk            = PPK::all();
          $budget         = Budget::all();
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
          return view('finance/outstation.edit',compact('data','petugas','kota','ppk','budget','act','sub',
                      'akun','div','user','destination','pok'
                    ));
      }

      function getNomorSPPD(Request $request){

        $sppd = Outst_employee::orderBy('id','desc')->whereYear('created_at',date('Y'))->get(); 
        $bidang = Divisi::select('kode_sppd')->where('id',$request->divisi_id)->first();
        $first = "0001";
        if($sppd->count()>0){
          $first = $sppd->first()->id+1;
            if($first < 10){
              $first = "000".$first;
            }else if($first < 100){
              $first = "00".$first;
            }else if($first < 1000){
            $first = "0".$first;
            }
        }
        $nomorbaru = $first."/".$bidang->kode_sppd."/SPPD/BBPOM"."/".date('Y');

        return response()->json([ 
            'success' => true,
            'nomorbaru' => $nomorbaru],200
        );
    }

      public function update(Request $request, $id)
      {
        $outstation_id = $id;
        DB::beginTransaction(); 
            $data = Outstation::find($id);
            $data->update($request->all());
            for ($j = 0; $j < count($request->destination_id); $j++){
                $tgl1 = new DateTime($request->go_date[$j]);
                $tgl2 = new DateTime($request->return_date[$j]);
                $daylong = $tgl2->diff($tgl1)->days + 1;
                
                $destination = [
                  'destination_id'=> $request->destination_id[$j],
                  'go_date' => $request->go_date[$j],
                  'return_date'  => $request->return_date[$j],
                  'longday' => $daylong,
                  'created_at' => Carbon::now()
                ];
                DB::table('outst_destiny')->updateOrInsert([
                  'outstation_id'=>$outstation_id,
                  'destination_id' =>$request->destination_id[$j]
                ],$destination);
            }
    
            for ($i = 0; $i < count($request->input('users_id')); $i++){
              $nomornya = $request->no_sppd[$i] == "" ?  $this->getnosppd($request->divisi_id) :  $request->no_sppd[$i];
             
              $pegawai = [
                    'outstation_id' => $outstation_id,
                    'users_id'      => $request->users_id[$i],
                    'no_sppd'        =>$nomornya,
                    'created_at' => Carbon::now()
              ];

              DB::table('outst_employee')->updateOrInsert([
                'no_sppd'=>$nomornya
              ],$pegawai);
            }
        DB::commit();
        return redirect('/finance/outstation')->with('sukses','Data Diperbaharui');
      }


      public function delete($id)
    {
        $data = Outstation::find($id);
        $data->delete();
        $petugas = Outst_employee::where('outstation_id',$id)->get();
        $petugas->delete();
        $kota = Outst_destiny::where('outstation_id',$id)->get();
        $kota->delete();
        return redirect('/finance/outstation')->with('sukses','Data Terhapus');
    }

}
