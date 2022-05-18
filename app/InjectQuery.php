<?php

namespace App;
use App\AduanDetail;
use App\Car;
use App\Destination;
use App\Entrystock;
use App\Eselontwo;
use App\Eselontwo_detail;
use App\Expenses_daily;
use App\Inventaris;
use App\JadwalCar;
use App\Outstation;
use App\Outst_destiny;
use App\Outst_employee;
use App\PengajuanDetail;
use App\Realrapk;
use App\Realrapk_detail;
use App\Setuprenker;
use App\Tagging;
use App\Travelexpenses;
use App\Travelexpenses1;
use App\Travelexpenses2;
use App\User;
use App\Vehiclerent;
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

    public function getkkp($id){
        $nilai = Travelexpenses2::where('outst_employee_id',$id)->first();
        return $nilai;
    }

    public function getUH($id){
        $dailyfee = Expenses_daily::Where('outst_employee_id',$id)->first();
        return $dailyfee;
    }

    public function getTr($id){
        $daily = Travelexpenses::Where('outst_employee_id',$id)->first();
        return $daily;
    }

    public function getPesawat($id){
        $pesawat = Travelexpenses1::SelectRaw('travelexpenses1.*, a.name AS maskapai1, b.name AS maskapai2, c.name AS maskapai3, d.name AS maskapaipulang')
                                    ->LeftJoin('plane AS a','a.id','=','travelexpenses1.plane_id1')
                                    ->LeftJoin('plane AS b','b.id','=','travelexpenses1.plane_id2')
                                    ->LeftJoin('plane AS c','c.id','=','travelexpenses1.plane_id3')
                                    ->LeftJoin('plane AS d','d.id','=','travelexpenses1.plane_idreturn')               
                                    ->Where('outst_employee_id',$id)->first();
                
        return $pesawat;
    }


    public function totalHarga($id){
        $nilai = Travelexpenses::Where('outst_employee_id',$id)->first();
        $nilai1 = Travelexpenses1::Where('outst_employee_id',$id)->first();
        $nilai2 = Expenses_daily::Where('outst_employee_id',$id)->first();
        $kkp = Travelexpenses2::Where('outst_employee_id',$id)->first();
        $days = Outst_destiny::SelectRaw('SUM(longday) AS hari')
                                ->LeftJoin('outstation','outstation.id','=','outst_destiny.outstation_id')
                                ->LeftJoin('outst_employee','outstation.id','=','outst_employee.outstation_id')
                                ->where('outst_employee.id',$id)->first();

        // transport
        $bbm            = $nilai1->bbm;

        if ($kkp->planekkp1 == 'N') {
            $plane1         = $nilai1->planefee1;
        } else {
            $plane1         = 0;
        }

        if ($kkp->planekkp2 == 'N') {
            $plane2         = $nilai1->planefee2;
        } else {
            $plane2         = 0;
        }

        if ($kkp->planekkp3 == 'N') {
            $plane3         = $nilai1->planefee3;
        } else {
            $plane3         = 0;
        }

        if ($kkp->planekkpreturn == 'N') {
            $planeret         = $nilai1->planereturnfee;
        } else {
            $planeret         = 0;
        }

        
        $taxicf         = $nilai1->taxy_count_from;
        $taxict         = $nilai1->taxy_count_to;
        $taxiff         = $nilai1->taxy_fee_from;
        $taxift         = $nilai1->taxy_fee_to;
        $taxifrom       = $taxicf*$taxiff;
        $taxides        = $taxict*$taxift;
        $transport      = $bbm+$plane1+$plane2+$plane3+$planeret+$taxifrom+$taxides;
      
        // harian
        $daily1          = $nilai2->dailywage1='Y' ? $nilai2->totdaily1 : '0';
        $daily2          = $nilai2->dailywage2='Y' ? $nilai2->totdaily2 : '0';
        $daily3          = $nilai2->dailywage3='Y' ? $nilai2->totdaily3 : '0';

        // harian meeting
        $diklat         = $nilai->diklat='Y' ? $nilai->totdiklat : '0';
        $fullboard      = $nilai->fullboard='Y' ? $nilai->totfullb : '0';
        $fullday        = $nilai->fullday='Y' ? $nilai->tothalf : '0';

        $harian = $daily1+$daily2+$daily3+$diklat+$fullboard+$fullday;
      
        // Pertemuan
        $meethalf       = $nilai->totdayshalf;
        $meetfull       = $nilai->totdaysfull;
        
        $pertemuan = $meethalf+$meetfull;

        // penginapan

        if ($kkp->hotelkkp1 == 'N') {
            $inn1 = $nilai1->klaim_1;
        } else {
            $inn1 = 0;
        }

        if ($kkp->hotelkkp2 == 'N') {
            $inn2 = $nilai1->klaim_2;
        } else {
            $inn2 = 0;
        }

        $penginapan = $inn1+$inn2;

        // eselon
        $eselon  = $nilai->representatif='Y' ? $nilai->totrep : '0';

        // Transport Lokal
        $Tlocal  = $nilai->tlokal='Y' ? $nilai->tottlokal : '0';

      

        $jumlah = $transport+$harian+$pertemuan+$penginapan+$eselon+$Tlocal;
        
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

    public function barang($id)
    {
        $data = Inventaris::where('id',$id)->first();
            return $data;
    }

    public function getHarga($id)
    {
        // $nilai = DB::select(DB::raw(" 
        //                 SELECT SUM(stock) AS stok, SUM(jumlah) AS total
        //                 FROM
        //                 (
        //                     SELECT stock, harga, (stock*harga) AS jumlah
        //                     FROM entrystock
        //                     WHERE inventaris_id = $id
        //                 ) nilai
        //                 "
        //                 ));
        $nilai = Entrystock::SelectRaw('SUM(stock) AS stok, SUM(stockawal) AS awal, SUM(harga) AS biaya')
                            ->where('inventaris_id',$id)
                            ->GroupBy('inventaris_id')
                            ->first();

            return $nilai;
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

//-----------------------------------------Carousel -----------------------------------------------------------
    public function getPinjamMobil($id){
        $isi1 = Vehiclerent::where('car_id',$id)
                            ->where('status','=','Y')
                            ->whereRaw("curdate() BETWEEN date_from AND date_to")
                            ->orderby('id','desc');
        $isi2 = Vehiclerent::where('car_id',$id)
                            ->where('status','=','Y')
                            ->whereRaw("curdate()+1 BETWEEN date_from AND date_to")
                            ->orderby('id','desc');
        $isi3 = Vehiclerent::where('car_id',$id)
                            ->where('status','=','Y')
                            ->whereRaw("curdate()+2 BETWEEN date_from AND date_to")
                            ->orderby('id','desc');
        $isi = Vehiclerent::where('car_id',$id)
                            ->where('status','=','Y')
                            ->whereRaw("curdate()+3 BETWEEN date_from AND date_to")
                            ->orderby('id','desc')
                            ->union($isi1)
                            ->union($isi2)
                            ->union($isi3)
                            ->first();
        return $isi;
    }

    public function getSTokBarang($id){
        $stok = Entrystock::selectraw('SUM(stock) AS stok')
                            ->where('inventaris_id',$id)
                            ->first();
        return $stok;
    }

    //-------------------Matriks Mobil--------------------
    public function pajak($id, $year, $mon){
        $pajak = Car::Where('id',$id)
                    ->whereYear('tax_date',$year)
                    ->whereMonth('tax_date',$mon)
                    ->first();
        return $pajak;
    }

    public function jadmain($id, $year, $mon){
        $main = JadwalCar::Select('tanggal')
                    ->Where('car_id',$id)
                    ->whereYear('tanggal',$year)
                    ->whereMonth('tanggal',$mon)
                    ->first();
        // return $main ? $main->tanggal : '';
        return $main;
    }
   
   
}