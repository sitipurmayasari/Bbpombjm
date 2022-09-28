<?php
namespace App\Http\Controllers\Calibration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\GetBakteri;
use PDF;

class LapTomikuController extends Controller
{

    public function index(Request $request)
    {
        return view('calibration/laptomiku.index');
    }

    public function cetak(Request $request)
    {
        // dd($request->all());
        $data = GetBakteri::OrderBY('id','asc')
                            ->whereYear('dates',$request->daftartahun)
                            ->when($request->bulan, function ($query) use ($request) {
                                if($request->bulan==2){
                                    $query->whereMonth('dates',$request->daftarbulan);
                                }
                            })
                            ->get();
        if ($data==null) {
            return redirect('/calibration/laptomiku')->with('gagal','Data Kosong');
        }
        return view('/calibration/laptomiku.cetakambil',compact('request','data'));        
    } 

}
