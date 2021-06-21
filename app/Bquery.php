<?php

namespace App;
use App\Dupak;

class Bquery
{
    public function outdupak($userId,$tahun,$bulan)
    {
        $dup = Dupak::select('total')
                    ->where('users_id',$userId)
                    ->whereYear('dari',$tahun)
                    ->whereMonth('dari',$bulan)
                    ->first();

        return $dup ? $dup->total : '';
        // if ($dup) {
        //     return $dup->total;
        // }
        // return '';
    }


}
