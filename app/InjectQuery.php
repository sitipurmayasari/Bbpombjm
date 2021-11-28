<?php

namespace App;
use App\User;
use App\Destination;
use App\PengajuanDetail;
use App\AduanDetail;
use App\Travelexpenses;
use App\Travelexpenses1;
use App\Outst_destiny;
use App\Tagging;
use App\Eselontwo;
use App\Eselontwo_detail;
use App\Setuprenker;
use App\Realrapk;
use App\Realrapk_detail;
use App\Outst_employee;
use App\Outstation;
use Illuminate\Support\Facades\DB;

class InjectQuery
{
//---------------------------CAROUSEL---------------------------------------------------------------------------
    public function getTujuan($id){
        $nilai = Outst_destiny::Where('outstation_id',$id)
                                ->LeftJoin('destination','destination.id','=','outst_destiny.destination_id')
                                ->get();
        return $nilai;
    }

    public function getPetugas($id){
        $nilai = Outst_employee::Where('outstation_id',$id)
                                ->LeftJoin('users','users.id','=','outst_employee.users_id')
                                ->get();
        return $nilai;
    }


//---------------------------KUITANSI---------------------------------------------------------------------------
    public function getDetail($id){
        $nilai = Travelexpenses1::Where('outst_employee_id',$id)->first();
        return $nilai;
    }

    public function getTr($id){
        $daily = Travelexpenses::Where('outst_employee_id',$id)->first();
        return $daily;
    }

    public function getPesawat($id){
        $daily = Travelexpenses::Where('outst_employee_id',$id)->first();
        return $daily;
    }


    public function totalHarga($id){
        $nilai = Travelexpenses::Where('outst_employee_id',$id)->first();
        $nilai1 = Travelexpenses1::Where('outst_employee_id',$id)->first();
        $days = Outst_destiny::SelectRaw('SUM(longday) AS hari')
                                ->LeftJoin('outstation','outstation.id','=','outst_destiny.outstation_id')
                                ->LeftJoin('outst_employee','outstation.id','=','outst_employee.outstation_id')
                                ->where('outst_employee.id',$id)->first();

        $hari = $days->hari;

        $daily          = $nilai->dailywage='Y' ? $nilai->hitdaily : '0';
        $diklat         = $nilai->diklat='Y' ? $nilai->hitdiklat : '0';
        $fullboard      = $nilai->fullboard='Y' ? $nilai->hitfullb : '0';
        $fullday        = $nilai->fullday='Y' ? $nilai->hithalf : '0';
        $representatif  = $nilai->representatif='Y' ? $nilai->hitrep : '0';

        $meetDF = $nilai->daysfull;
        $meetDH = $nilai->dayshalf;
        $meetFF = $nilai->feefull;
        $meetFH = $nilai->feehalf;

        $innb1 = $nilai1->inn_fee_1;
        $innlong1 = $nilai1->long_stay_1;
        $innb2 = $nilai1->inn_fee_2;
        $innlong2 = $nilai1->long_stay_2;
        $taxicf = $nilai1->taxy_count_from;
        $taxict = $nilai1->taxy_count_to;
        $taxiff = $nilai1->taxy_fee_from;
        $taxift = $nilai1->taxy_fee_to;

        $Uharian        = $hari*$daily;
        $Udiklat        = $hari*$diklat;
        $Ufullb         = $hari*$fullboard;
        $Ufulld         = $hari*$fullday;
        $reps           = $hari*$representatif;
        $TemuFullboard  = $meetDF*$meetFF;
        $temuFullday    = $meetDH*$meetFH;
        $bbm            = $nilai1->bbm;
        $plane1         = $nilai1->planefee1;
        $plane2         = $nilai1->planefee2;
        $plane3         = $nilai1->planefee3;
        $inn1           = $innb1*$innlong1;
        $inn2           = $innb2*$innlong2;
        $taxifrom       = $taxicf*$taxiff;
        $taxito         = $taxict*$taxift;

        $harian     = $Uharian+$Udiklat+$Ufullb+$Ufulld+$reps;
        $pertemuan  = $TemuFullboard+$temuFullday;
        $perjalanan = $bbm+$plane1+$plane2+$plane3+$taxifrom+$taxito;
        $penginapan = $inn1+$inn2;

        $jumlah = $harian+$pertemuan+$perjalanan+$penginapan;
        
        return $jumlah;

    }

//------------------------------LAPORAN BARANG------------------------------------------------------------------------
    public function getDaftarBrgAduan($aduanId)
    {
        $daftaraduan = AduanDetail::SelectRaw('aduan_detail.* , inventaris.nama_barang, inventaris.merk')
                                    ->LeftJoin('inventaris', 'inventaris.id','=','aduan_detail.inventaris_id')
                                    ->where('aduan_id',$aduanId)->get();
            return $daftaraduan;
       
    }

    public function getDaftarBrgAjuan($ajuanId)
    {
        $daftarajuan = PengajuanDetail::where('pengajuan_id',$ajuanId)->get();
            return $daftarajuan;
    }

//------------------------------TAGGING ANGGARAN------------------------------------------------------------------------  
    public function getTag($pagu_id, $subcode_id){
        $tag = Tagging::Where('pagu_id',$pagu_id)
                        ->Where('subcode_id',$subcode_id)
                        ->first();
        return $tag;
    }

    public function getIndi($pagu_id, $indicator_id){
        $hitung = Tagging::SelectRaw('COUNT(indicator_id) AS jum')
                            ->Where('pagu_id',$pagu_id)
                            ->Where('indicator_id',$indicator_id)
                            ->first();
        return $hitung;
    }
    public function getjumbar($pagu_id, $subcode_id){
        $hitung = Tagging::SelectRaw('COUNT(indicator_id) AS jum')
                            ->Where('pagu_id',$pagu_id)
                            ->Where('subcode_id',$subcode_id)
                            ->first();
        return $hitung;
    }

    public function getDaftarTag($subcode_id){
        $hitung = Tagging::SelectRaw('tagging.*')
                            ->Where('pagu.year',$tahun)
                            ->Where('subcode_id',$subcode_id)
                            ->first();
        return $hitung;
    }

    // public function getAllIndi($subcode_id, $pagu_id){
    //     $last = $pagu_id - 1;
    //     $list = Tagging::Where('subcode_id',$subcode_id)
    //                     ->Where('pagu_id',$last)
    //                     ->get();
    //     return $list;
    // }

//--------------------------------------------Renstra------------------------------------------------------------------
    public function getRenstra($id, $year,$indi){
        $isi = Renstranas_detail::where('years',$year)
                                ->where('renstranas_id',$id)
                                ->where('indicator_id',$indi)
                                ->first();
        return $isi;
    }

    public function getNasional($year,$indi){
        $isi = Renstranas_detail::where('years',$year)
                                ->where('indicator_id',$indi)
                                ->OrderBy('id','desc')
                                ->first();
        return $isi;
    }

    public function getRenstrakal($id, $year,$indi){
        $isi = Renstrakal_detail::where('years',$year)
                                ->where('renstrakal_id',$id)
                                ->where('indicator_id',$indi)
                                ->first();
        return $isi;
    }

    public function getTarget($id){
        $hitung = Indicator::SelectRaw('COUNT(*) AS rowing')
                            ->Where('target_id',$id)
                            ->first();
        return $hitung;
    }

    public function getPers($id){
        $hitung = indicator::SelectRaw('COUNT(*) AS rowing')
                            ->LeftJoin('target','target.id','=','indicator.target_id')
                            ->Where('target.perspective_id',$id)
                            ->first();
        return $hitung;
    }

//--------------------------------------------RAPK------------------------------------------------------------------    //

    public function geteselontw($id, $indi){
        $isi = Eselontwo_detail::where('indicator_id',$indi)
                                ->where('eselontwo_id',$id)
                                ->first();
        return $isi;
    }
//-----------------------------------------REALISASI RAPK-----------------------------------------------------------

    public function getRealTW($tw, $year,$indi){
        $data= Realrapk::where('years',$year)->where('triwulan',$tw)->first();
        $isi = Realrapk_detail::where('realrapk_id',$data->id)
                            ->where('indicator_id',$indi)
                            ->first();
        return $isi;
    }

    public function getKriteriaTW($nilai){
        $isi = Setuprenker::where('jenis','Lapkin')
                            ->whereRaw("$nilai BETWEEN rentang_awal AND rentang_akhir")
                            ->first();
        return $isi;
    }

    public function getKriteriaTH($nilai){
        $isi = Setuprenker::where('jenis','Lapkin')
                            ->whereRaw("$nilai BETWEEN rentang_awal AND rentang_akhir")
                            ->first();
        return $isi;
    }

    public function getAVGSK($target){
        $isi = Realrapk_detail::SelectRaw('AVG(nps) as hasil')
                            ->LeftJoin('indicator','indicator.id','=','realrapk_detail.indicator_id')
                            ->where('target_id',$target)
                            ->where('nps','!=','0')
                            ->first();
        return $isi;
    }

    public function getAVGPers($pers){
        $isi = Realrapk_detail::SelectRaw('AVG(nps) as hasil')
                            ->LeftJoin('indicator','indicator.id','=','realrapk_detail.indicator_id')
                            ->LeftJoin('target','target.id','=','indicator.target_id')
                            ->where('perspective_id',$pers)
                            ->where('nps','!=','0')
                            ->first();
        return $isi;
    }

    public function getPaguRAPK($indi,$pagu){
        $isi = Tagging::SelectRaw('SUM(pagusub) AS pagu, SUM(realisasisub) AS realisasi')
                            ->LeftJoin('realrapk_detail','realrapk_detail.indicator_id','=','tagging.indicator_id')
                            ->where('tagging.indicator_id',$indi)
                            ->where('tagging.pagu_id',$pagu)
                            ->first();
        return $isi;
    }
    
    public function getKriteriaTE($nilai){
        $isi = Setuprenker::where('jenis','TE')
                            ->whereRaw("$nilai BETWEEN rentang_awal AND rentang_akhir")
                            ->first();
        return $isi;
    }
   
}