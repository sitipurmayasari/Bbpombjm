<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Tukin;
use App\TukinDetail;
use Excel;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

use App\Imports\TukinImport;

class TukinController extends Controller
{
    public function index(Request $request)
    {
        $data = Tukin::orderBy('id','desc')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('nomor','LIKE','%'.$request->keyword.'%')
                            ->orWhere('tanggal', 'LIKE','%'.$request->keyword.'%');
                    })
                ->paginate('10');
        return view('amdk/tukin.index',compact('data'));
    }

    public function create()
    {
        $user = User::all()
                ->where('id','!=','1');
        $no_tukin = $this->getNoTukin();
        return view('amdk/tukin.create',compact('user','no_tukin'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'nomor' => 'required|unique:tukin',
            'tanggal' => 'required|date',
            'bulan'=> 'required',
            'tahun'=> 'required'
        ]);

        DB::beginTransaction();
            $tukin =Tukin::create($request->all());
            $tukin_id = $tukin->id;
            for ($i = 0; $i < count($request->input('users_id')); $i++){
                $data = [
                    'tukin_id' => $tukin_id,
                    'users_id' => $request->users_id[$i] ,
                    'nilai' => $request->nilai[$i],
                    'potongan' => $request->potongan[$i],
                    'potonganRp' => $request->potonganRp[$i],
                    'terima' => $request->terima[$i]
                ];
                if ($request->nilai[$i]!=0) {
                    TukinDetail::create($data);
                }
               
            }
        DB::commit(); 

        return redirect('/amdk/tukin');

    }
   
   
    public function edit($id)
    {
        $user = User::all()
                ->where('id','!=','1');
        $detail = TukinDetail::where('tukin_id',$id)
                    ->get();
        $data = Tukin::where('id',$id)
                ->first();
        $bulan =$data->bulan;
        return view('amdk/tukin.edit',compact('data','detail','user','bulan'));
    }

    public function update(Request $request,$id)
    {
        // dd($request->all());

        $this->validate($request,[
            'bulan'=> 'required',
            'tahun'=> 'required'
        ]);

        DB::beginTransaction();
            for ($i = 0; $i < count($request->input('users_id')); $i++){
                $data = [
                    'nilai' => $request->nilai[$i],
                    'potongan' => $request->potongan[$i],
                    'potonganRp' => $request->potonganRp[$i],
                    'terima' => $request->terima[$i]
                ];
                Tukin::where('id',$id)->update(['bulan'=>$request->bulan, 'tahun'=>$request->tahun]);
                TukinDetail::where('tukin_id',$id)
                            ->where('users_id', $request->users_id[$i])
                            ->update($data);
            }
        DB::commit(); 

        return redirect('/amdk/tukin')->with('sukses','Data Berhasil Diperbaharui');

    }
   
    function getNoTukin(){
        $aduan = Tukin::orderBy('id','desc')->whereYear('tanggal',date('Y'))->get();
        $first = "001";
        if($aduan->count()>0){
          $first = $aduan->first()->id+1;
          if($first < 10){
              $first = "00".$first;
          }else if($first < 100){
              $first = "0".$first;
          }
        }
        $no_aduan = $first."/TU/TUKIN/".date('m')."/".date('Y');
        return $no_aduan;
      }

      public function getAsn(Request $request)
      {
 
          $asn = User::orderBy('name','asc')
                  ->where('status','PNS')
                  ->where('id','!=','1')
                  ->where('aktif','Y')
                  ->get();
  
          return response()->json([ 
              'success' => true,
              'asn'=>$asn
             
              
          ],200);
      }


      public function print($id){
          $data = Tukin::where('id',$id)
                ->select('tukin.*', DB::raw('CASE
                                                WHEN bulan= 1 THEN "Januari"
                                                WHEN bulan= 2 THEN "Februari"
                                                WHEN bulan= 3  THEN "Maret"
                                                WHEN bulan= 4  THEN "April"
                                                WHEN bulan= 5  THEN "Mei"
                                                WHEN bulan= 6  THEN "Juni"
                                                WHEN bulan= 7  THEN "Juli"
                                                WHEN bulan= 8  THEN "Agustus"
                                                WHEN bulan= 9  THEN "September"
                                                WHEN bulan= 10  THEN "Oktober"
                                                WHEN bulan= 11  THEN "November"
                                                ELSE "Desember"
                                            END bln')
                        )
                ->first();
          $isi = TukinDetail::where('tukin_id',$id)
                            ->where('terima','!=','0')
                            ->get();
          $user = User::all(); 

          $pdf = PDF::loadview('amdk/tukin.print',compact('data','isi','user'));
      
            return $pdf->stream();
      }


      public function impor(Request $request)
      {
          $this->validate($request, [
              'diimpor' => 'required|mimes:csv,xls,xlsx',
              'nomor' => 'required|unique:tukin',
              'tanggal' => 'required|date',
              'bulan'=> 'required',
              'tahun'=> 'required'
          ]);
        
         


          $file = $request->diimpor;
          $nama_file = $file->getClientOriginalName();
  
          $file->move('excel',$nama_file);
   
        //   // import data
        DB::beginTransaction();
            $tukin =Tukin::create($request->all());
            $tukin_id = $tukin->id;

          Excel::import(new TukinImport($tukin_id), urlStorage().'/excel/'.$nama_file);
        
        DB::commit();
  
          return redirect('/amdk/tukin');
   
      }

    
}
