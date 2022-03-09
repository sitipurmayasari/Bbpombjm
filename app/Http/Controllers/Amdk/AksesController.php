<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Menu;
use App\Submenu;
use Illuminate\Support\Collection;
use App\UserPermission;
use Illuminate\Support\Facades\DB;


class AksesController extends Controller
{
    public function index()
    {
        $user = User::where('aktif','Y')->get();    
        return view('amdk/akses.index',compact('user'));
    }

   
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'user_id'=> 'required'
        ]);

        DB::beginTransaction();
            $deleteDulu = UserPermission::where('user_id',$request->user_id)->delete();
            if ($request->input('akses_amdk')) {
                for ($i = 0; $i < count($request->input('akses_amdk')); $i++){
                    $data = [
                        'user_id' => $request->user_id,
                        'menu_id' => $request->akses_amdk[$i] ,
                    ];
                    UserPermission::create($data);
                }
            }

            if ($request->input('akses_fin')) {
                for ($i = 0; $i < count($request->input('akses_fin')); $i++){
                    $data = [
                        'user_id' => $request->user_id,
                        'menu_id' => $request->akses_fin[$i] ,
                    ];
                    UserPermission::create($data);
                }
            }
           
            if ($request->input('akses_inv')) {
                for ($i = 0; $i < count($request->input('akses_inv')); $i++){
                    $data = [
                        'user_id' => $request->user_id,
                        'menu_id' => $request->akses_inv[$i] ,
                    ];
                    UserPermission::create($data);
                }
            }
           
        DB::commit(); 
        return redirect()->route('akses')->with('sukses','Data Tersimpan');
       
    }


    public function getMenuUser(Request $request)
    {
        $user_id = $request->user_id;
        $amdk = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('menu.modul','amdk')
            ->get();

        $inventaris = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('menu.modul','inventaris')
            ->get();

        $finance = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('menu.modul','finance')
            ->get();

        $outputAmdk = array();
        foreach ($amdk as $am) {
            $outputAmdk[] = array(
                'id' => $am->id,
                'nama' => $am->nama,
                'checked' => $this->checkPermissonMenu($user_id,$am->id)
            );
        }
        $outputInventaris = array();
        foreach ($inventaris as $in) {
            $outputInventaris[] = array(
                'id' => $in->id,
                'nama' => $in->nama,
                'checked' => $this->checkPermissonMenu($user_id,$in->id)
            );
        }
        $outputFinance = array();
        foreach ($finance as $in) {
            $outputFinance[] = array(
                'id' => $in->id,
                'nama' => $in->nama,
                'checked' => $this->checkPermissonMenu($user_id,$in->id)
            );
        }

        return response()->json([ 
            'success' => true,
            'amdk'=>$outputAmdk,
            'inventaris' => $outputInventaris,
            'finance' => $outputFinance
        ],200);
    }



    
    public function checkPermissonMenu($userId,$menuId)
    {
        $permission = UserPermission::where('user_id',$userId)
                    ->where('menu_id',$menuId)
                    ->get()
                    ->count();
        if ($permission>0) {
            return true;
        }else{
            return false;
        }
    }
}
