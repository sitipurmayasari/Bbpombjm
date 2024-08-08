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

            if ($request->input('akses_arsip')) {
                for ($i = 0; $i < count($request->input('akses_arsip')); $i++){
                    $data = [
                        'user_id' => $request->user_id,
                        'menu_id' => $request->akses_arsip[$i] ,
                    ];
                    UserPermission::create($data);
                }
            }

            if ($request->input('akses_dinas')) {
                for ($i = 0; $i < count($request->input('akses_dinas')); $i++){
                    $data = [
                        'user_id' => $request->user_id,
                        'menu_id' => $request->akses_dinas[$i] ,
                    ];
                    UserPermission::create($data);
                }
            }

            if ($request->input('akses_plan')) {
                for ($i = 0; $i < count($request->input('akses_plan')); $i++){
                    $data = [
                        'user_id' => $request->user_id,
                        'menu_id' => $request->akses_plan[$i] ,
                    ];
                    UserPermission::create($data);
                }
            }

            if ($request->input('akses_forma')) {
                for ($i = 0; $i < count($request->input('akses_forma')); $i++){
                    $data = [
                        'user_id' => $request->user_id,
                        'menu_id' => $request->akses_forma[$i] ,
                    ];
                    UserPermission::create($data);
                }
            }

            if ($request->input('akses_kuli')) {
                for ($i = 0; $i < count($request->input('akses_kuli')); $i++){
                    $data = [
                        'user_id' => $request->user_id,
                        'menu_id' => $request->akses_kuli[$i] ,
                    ];
                    UserPermission::create($data);
                }
            }

            if ($request->input('akses_aluh')) {
                for ($i = 0; $i < count($request->input('akses_aluh')); $i++){
                    $data = [
                        'user_id' => $request->user_id,
                        'menu_id' => $request->akses_aluh[$i] ,
                    ];
                    UserPermission::create($data);
                }
            }


            if ($request->input('akses_qms')) {
                for ($i = 0; $i < count($request->input('akses_qms')); $i++){
                    $data = [
                        'user_id' => $request->user_id,
                        'menu_id' => $request->akses_qms[$i] ,
                    ];
                    UserPermission::create($data);
                }
            }

            if ($request->input('akses_nappza')) {
                for ($i = 0; $i < count($request->input('akses_nappza')); $i++){
                    $data = [
                        'user_id' => $request->user_id,
                        'menu_id' => $request->akses_nappza[$i] ,
                    ];
                    UserPermission::create($data);
                }
            }

            if ($request->input('akses_mikro')) {
                for ($i = 0; $i < count($request->input('akses_mikro')); $i++){
                    $data = [
                        'user_id' => $request->user_id,
                        'menu_id' => $request->akses_mikro[$i] ,
                    ];
                    UserPermission::create($data);
                }
            }

            if ($request->input('akses_otkos')) {
                for ($i = 0; $i < count($request->input('akses_otkos')); $i++){
                    $data = [
                        'user_id' => $request->user_id,
                        'menu_id' => $request->akses_otkos[$i] ,
                    ];
                    UserPermission::create($data);
                }
            }

            // if ($request->input('akses_ppnpn')) {
            //     for ($i = 0; $i < count($request->input('akses_ppnpn')); $i++){
            //         $data = [
            //             'user_id' => $request->user_id,
            //             'menu_id' => $request->akses_ppnpn[$i] ,
            //         ];
            //         UserPermission::create($data);
            //     }
            // }
           
        DB::commit(); 
        return redirect()->route('akses')->with('sukses','Data Tersimpan');
       
    }


    public function getMenuUser(Request $request)
    {
        $user_id = $request->user_id;
        $amdk = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('aktif','Y')
            ->where('menu.modul','amdk')
            ->get();

        $inventaris = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('aktif','Y')
            ->where('menu.modul','inventaris')
            ->get();

        $finance = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('aktif','Y')
            ->where('menu.modul','finance')
            ->get();

        $arsip = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('aktif','Y')
            ->where('menu.modul','arsip')
            ->get();

        $dinas = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('aktif','Y')
            ->where('menu.modul','dinas')
            ->get();

        $plan = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('aktif','Y')
            ->where('menu.modul','plan')
            ->get();

        $forma = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('aktif','Y')
            ->where('menu.modul','forma')
            ->get();

        $kuli = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('aktif','Y')
            ->where('menu.modul','kuli')
            ->get();
        
        $aluh = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('aktif','Y')
            ->where('menu.modul','aluh')
            ->get();

        $qms = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('aktif','Y')
            ->where('menu.modul','qms')
            ->get();

        $nappza = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('aktif','Y')
            ->where('menu.modul','napza')
            ->get();
        
        $mikro = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('aktif','Y')
            ->where('menu.modul','mikro')
            ->get();

        $otkos = Submenu::orderBy('menu.id','asc')
            ->select('submenu.*','menu.modul','menu.nama as group_nama')
            ->leftJoin('menu','submenu.menu_id','=','menu.id')
            ->where('aktif','Y')
            ->where('menu.modul','otkos')
            ->get();

        // $ppnpn = Submenu::orderBy('menu.id','asc')
        //     ->select('submenu.*','menu.modul','menu.nama as group_nama')
        //     ->leftJoin('menu','submenu.menu_id','=','menu.id')
        // ->where('aktif','Y')
        //     ->where('menu.modul','ppnpn')
        //     ->get();

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

        $outputArsip = array();
        foreach ($arsip as $in) {
            $outputArsip[] = array(
                'id' => $in->id,
                'nama' => $in->nama,
                'checked' => $this->checkPermissonMenu($user_id,$in->id)
            );
        }

        $outputDinas = array();
        foreach ($dinas as $in) {
            $outputDinas[] = array(
                'id' => $in->id,
                'nama' => $in->nama,
                'checked' => $this->checkPermissonMenu($user_id,$in->id)
            );
        }

        $outputPlan = array();
        foreach ($plan as $in) {
            $outputPlan[] = array(
                'id' => $in->id,
                'nama' => $in->nama,
                'checked' => $this->checkPermissonMenu($user_id,$in->id)
            );
        }

        $outputForma = array();
        foreach ($forma as $in) {
            $outputForma[] = array(
                'id' => $in->id,
                'nama' => $in->nama,
                'checked' => $this->checkPermissonMenu($user_id,$in->id)
            );
        }

        $outputkuli = array();
        foreach ($kuli as $in) {
            $outputkuli[] = array(
                'id' => $in->id,
                'nama' => $in->nama,
                'checked' => $this->checkPermissonMenu($user_id,$in->id)
            );
        }

        $outputaluh = array();
        foreach ($aluh as $in) {
            $outputaluh[] = array(
                'id' => $in->id,
                'nama' => $in->nama,
                'checked' => $this->checkPermissonMenu($user_id,$in->id)
            );
        }

        $outputqms = array();
        foreach ($qms as $in) {
            $outputqms[] = array(
                'id' => $in->id,
                'nama' => $in->nama,
                'checked' => $this->checkPermissonMenu($user_id,$in->id)
            );
        }

        $outputnappza = array();
        foreach ($nappza as $in) {
            $outputnappza[] = array(
                'id' => $in->id,
                'nama' => $in->nama,
                'checked' => $this->checkPermissonMenu($user_id,$in->id)
            );
        }

        $outputmikro = array();
        foreach ($mikro as $in) {
            $outputmikro[] = array(
                'id' => $in->id,
                'nama' => $in->nama,
                'checked' => $this->checkPermissonMenu($user_id,$in->id)
            );
        }
        
        $outputotkos = array();
        foreach ($otkos as $in) {
            $outputotkos[] = array(
                'id' => $in->id,
                'nama' => $in->nama,
                'checked' => $this->checkPermissonMenu($user_id,$in->id)
            );
        }

        // $outputppnpn = array();
        // foreach ($ppnpn as $in) {
        //     $outputppnpn[] = array(
        //         'id' => $in->id,
        //         'nama' => $in->nama,
        //         'checked' => $this->checkPermissonMenu($user_id,$in->id)
        //     );
        // }


        return response()->json([ 
            'success' => true,
            'amdk'=>$outputAmdk,
            'inventaris' => $outputInventaris,
            'finance' => $outputFinance,
            'arsip' => $outputArsip,
            'forma' => $outputForma,
            'kuli' => $outputkuli,
            'aluh' => $outputaluh,
            'dinas' => $outputDinas,
            'plan' => $outputPlan,
            'qms' => $outputqms,
            'nappza' => $outputnappza,
            'mikro' => $outputmikro,
            'otkos' => $outputotkos
            // 'ppnpn' => $outputppnpn
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
