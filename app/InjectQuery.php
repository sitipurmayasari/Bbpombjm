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
use Illuminate\Support\Facades\DB;

class InjectQuery
{

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

   
}