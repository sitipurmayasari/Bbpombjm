<?php

namespace App;
use App\realisasi;
Use App\RealisasiDetail;
use App\Pok_detail;
use App\Pok;
use Illuminate\Support\Facades\DB;

class PoaQuery
{
    public function minggu($tahun,$bulan)
    {
        $dup = RealisasiDetail::SelectRaw('DISTINCT(week) as mingguan')
                                ->LeftJoin('realisasi','realisasi.id','=','realisasi_detail.realisasi_id')
                                ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                ->where('pok.year',$tahun)
                                ->where('realisasi_detail.month',$bulan)
                                ->first();

        return $dup ? $dup->mingguan : '';
    }

    public function nilaibulan($tahun,$bulan)
    {
        $dup = RealisasiDetail::SelectRaw('sum(realisasi_detail.biaya) as total')
                                ->LeftJoin('realisasi','realisasi.id','=','realisasi_detail.realisasi_id')
                                ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                ->where('pok.year',$tahun)
                                ->where('realisasi_detail.month',$bulan)
                                ->first();

        return $dup ? number_format($dup->total) : '';
    }

    public function nilaiminggu($tahun,$bulan,$minggu)
    {
        $dup = RealisasiDetail::SelectRaw('sum(realisasi_detail.biaya) as total')
                                ->LeftJoin('realisasi','realisasi.id','=','realisasi_detail.realisasi_id')
                                ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                ->where('pok.year',$tahun)
                                ->where('realisasi_detail.month',$bulan)
                                ->where('realisasi_detail.week',$minggu)
                                ->first();
        return $dup ? number_format($dup->total) : '';
    }

    public function nilaitriwulan($tahun,$triwulan)
    {
        $dup = RealisasiDetail::SelectRaw('sum(realisasi_detail.biaya) as total')
                                ->LeftJoin('realisasi','realisasi.id','=','realisasi_detail.realisasi_id')
                                ->LeftJoin('pok_detail','pok_detail.id','=','realisasi.pok_detail_id')
                                ->LeftJoin('pok','pok.id','=','pok_detail.pok_id')
                                ->where('pok.year',$tahun)
                                ->whereIn('realisasi_detail.month',$triwulan)
                                ->first();
        return $dup ? number_format($dup->total) : '';
    }


   


}
