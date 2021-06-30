<?php

namespace App;
use App\Dupak;
use Illuminate\Support\Facades\DB;

class Bquery
{
    public function outdupak($userId,$tahun,$bulan)
    {
        $dup = Dupak::select('total')
                    ->where('users_id',$userId)
                    ->whereYear('sampai',$tahun)
                    ->whereMonth('sampai',$bulan)
                    ->first();

        return $dup ? $dup->total : '';
        // if ($dup) {
        //     return $dup->total;
        // }
        // return '';
    }

    public function jumsmt($tahun)
    {
        $sql ="SELECT COUNT(bulan) as hitung
                FROM (SELECT month(sampai) AS bulan, YEAR(sampai) AS tahun
                            FROM dupak
                            GROUP BY sampai) ini
                WHERE tahun = $tahun";

        $smt = DB::select($sql);

        return $smt ? $smt[0]->hitung : '';
       
    }

   


}
