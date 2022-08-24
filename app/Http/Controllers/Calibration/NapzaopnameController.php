<?php
namespace App\Http\Controllers\Calibration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Inventaris;
use App\Lokasi;
use App\Satuan;
use App\Jenisbrg;
use App\Entrystock;
use App\Petugas;
use App\Pejabat;
use App\Opname;
use App\Opnamedetail;
use PDF;
use Excel;
use App\Imports\OpnameImport;

class NapzaopnameController extends Controller
{

    public function index(Request $request)
    {
        $opname = Opname::all();
        $jenis = Jenisbrg::whereraw('id in (3,21)')->get();
        return view('calibration/napzaopname.index',compact('jenis','opname'));
    }

    public function formopname()
    {
        $data = Inventaris::where('lokasi','10')
                        ->whereraw('jenis_barang in (3,21)')
                        ->OrderBy('id','asc')
                        ->get();
        return view('calibration/napzaopname.formopname', compact('data'));
    }

    public function create()
    {
        $data = Opname::orderBy('id','desc')
                    ->get();
        return view('calibration/napzaopname.create',compact('data'));
    }

    public function store(Request $request)
    {
       
        $this->validate($request, [
            'imporfile' => 'required|mimes:csv,xls,xlsx',
            'dates' => 'required|date',
            'periode'=> 'required'
        ]);

        $file = $request->imporfile;
        $nama_file = $file->getClientOriginalName();

        $file->move('excel',$nama_file);

      DB::beginTransaction();
            $opname =Opname::create($request->all());
            $opname_id = $opname->id;

          Excel::import(new OpnameImport($opname_id), public_path('/excel/'.$nama_file));
      
      DB::commit();

        return redirect('/calibration/napzaopname')->with('sukses','Data Berhasil Diimport');
 
    }

    public function cetakopname($id)
    {
      $data = Opname::where('id',$id)->first();
      $detail = Opnamedetail::where('opname_id',$id)->get();
    
      return view('/calibration/napzaopname.cetakopname',compact('data','detail'));

      
    }

    public function cetak(Request $request)
    {
      $data = Opname::where('id',$request->opname_id)->first();
      
      $detail = Opnamedetail::where('opname_id',$data->id)
                            ->leftjoin('inventaris','inventaris.id','opnamedetail.inventaris_id')
                            ->where('inventaris.lokasi','=','10')
                            ->where('inventaris.jenis_barang','=',$request->kelompok)
                            ->get();
      $jenis = Jenisbrg::where('id',$request->kelompok)->first();
      return view('/calibration/napzaopname.cetak',compact('request','data','detail','jenis'));            
    } 

}
