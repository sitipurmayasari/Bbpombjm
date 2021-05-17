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