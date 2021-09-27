<?php
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

function MyMenu($modul)
{
    $user = Auth::user();
    $user_id = $user->id;
    $menu =
        DB::table('user_permission')
            ->select('menu.*')
            ->groupBy('menu.id')
            ->join('submenu','submenu.id','=','user_permission.menu_id')
            ->join('menu','menu.id','=','submenu.menu_id')
            ->where('user_permission.user_id',$user_id)
            ->where('modul',$modul)
            ->orderBy('menu.urutan','asc')
            ->get();
    return $menu;
}

function mySubMenu($groupMenuId)
{
    $user = Auth::user();
    $user_id = $user->id;
    $menu =
        DB::table('user_permission')
            ->select('submenu.*')
            ->join('submenu','submenu.id','=','user_permission.menu_id')
            ->where('user_permission.user_id',$user_id)
            ->where('submenu.menu_id',$groupMenuId)
            ->get();
    return $menu;
}
function urlStorage(){
    // return "/home/bbpombjm/public_html";

    return "/home/u1275760/public_html/sibob";
}
function tgl_indo($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}