<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\DB;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

      $id = Auth::user()->id;
      $hitLink = request()->route()->uri();
      $permission = DB::table('user_permission')
                    ->select('user_permission.*','submenu.link')
                    ->leftJoin('submenu','submenu.id','=','user_permission.menu_id')
                    ->where('user_id',$id)
                    ->where('submenu.link', '/'.$hitLink)
                    ->get();

        foreach ($permission as $akses) {
            $myAkses = $akses->link;
            if ($myAkses=='/'.$hitLink) {
                return $next($request);
            }
        }
        if ($permission->count()==0) {
            if ($hitLink == 'amdk/dashboard' || $hitLink == 'invent/dashboard') {
                return $next($request);
            }
        }
       
        return redirect('/layouts/portal')->with('gagal','Anda Tidak Punya Akses Di Menu ini');
    }
}
