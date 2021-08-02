<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use App\Imports\JabasnImport;
use App\Imports\UserImport;
use App\Imports\InventImport;
use App\Imports\StokImport;

class ImportExcelController extends Controller
{
    public function index(){
        return view('import.index');
    }
    public function jabasn(Request $request)
    {
        $this->validate($request, [
            'jabsn' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->jabsn;
        $nama_file = $file->getClientOriginalName();

		$file->move('excel',$nama_file);
 
		// import data
        Excel::import(new JabasnImport, urlStorage().'/excel/'.$nama_file);
        // Excel::import(new JabasnImport, public_path('/excel/'.$nama_file));

        return redirect()->route('import');
 
    }

    public function users(Request $request)
    {
        $this->validate($request, [
            'users' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->users;
        $nama_file = $file->getClientOriginalName();

		$file->move('excel',$nama_file);
 
		// import data
        Excel::import(new UserImport, urlStorage().'/excel/'.$nama_file);
        // Excel::import(new UserImport, public_path('/excel/'.$nama_file));

        return redirect()->route('import');
 
    }

    public function inventaris(Request $request)
    {
        $this->validate($request, [
            'inventaris' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->inventaris;
        $nama_file = $file->getClientOriginalName();

		$file->move('excel',$nama_file);
 
		// import data
        Excel::import(new InventImport, urlStorage().'/excel/'.$nama_file);
        // Excel::import(new InventImport, public_path('/excel/'.$nama_file));

        return redirect()->route('import');
 
    }

    public function stok(Request $request)
    {
        $this->validate($request, [
            'stok' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->stok;
        $nama_file = $file->getClientOriginalName();

		$file->move('excel',$nama_file);
 
		// import data
        // Excel::import(new StokImport, public_path('/excel/'.$nama_file));
        Excel::import(new StokImport, urlStorage().'/excel/'.$nama_file);

        return redirect()->route('import');
 
    }
}
