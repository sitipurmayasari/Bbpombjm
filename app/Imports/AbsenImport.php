<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Absensi;
use App\User;
use App\Libur;
use App\Setabsen;


class AbsenImport implements ToModel,WithStartRow
{

    public function startRow(): int
    {
        return 6;
    }
    public function model(array $row)
    {
        $date = str_replace('/', '-', $row[2]);
        $tanggal = date('Y-m-d', strtotime($date));
        $tahun = date("Y",strtotime($tanggal));
        $bulan = date("m",strtotime($tanggal));

        $masuk      = $row[4];
        $pulang     = $row[5];
        $checkin    = $row[6];
        $checkout   = $row[7];
        // $late       = $row[9];
        // $early      = $row[10]; 
        
        
        // terlambat
        if ($checkin > $masuk) {
            $a = date_create($checkin);
            $b = date_create($masuk);
            $interval1 = date_diff($a, $b); 
            $late = $interval1->days * 24 * 60;
            $late += $interval1->h * 60;
            $late += $interval1->i;
            
            $x = $interval1->h;
            $y = $interval1->i;
            $z = date_create($tanggal);
            $time = date_time_set($z,$x,$y);
            $terlambat = date_format($time,"H:i:s");

        } else {
            $late = 0;
            $terlambat = "00:00:00";
        }
        
        
        // pulang cepat
        if ($pulang > $checkout ) {
            $c = date_create($pulang);
            $d = date_create($checkout);
            $interval2 = date_diff($c, $d); 
            $early = $interval2->days * 24 * 60;
            $early += $interval2->h * 60;
            $early += $interval2->i;

            $x = $interval2->h;
            $y = $interval2->i;
            $z = date_create($tanggal);
            $time = date_time_set($z,$x,$y);
            $pulang_cepat = date_format($time,"H:i:s");

        } else {
           $early = 0;
           $pulang_cepat = "00:00:00";
        }
        

        //poin
        $set = Setabsen::first();

        if ($late > 0 && $late <= 15) {
            $lambat = $set->poin1;
        }elseif ($late > 15 && $late <= 30)  {
            $lambat = $set->poin16;
        }elseif ($late > 30 && $late <= 60)  {
            $lambat = $set->poin31;
        }elseif ($late > 60 && $late <= 90)  {
            $lambat = $set->poin61;
        }elseif ($late > 90 )  {
            $lambat = $set->poin91;
        } else {
            $lambat = 0;
        }

        if ($early > 0 && $early <= 15) {
            $cepat = $set->poin1;
        }elseif ($early > 15 && $early <= 30)  {
            $cepat = $set->poin16;
        }elseif ($early > 30 && $early <= 60)  {
            $cepat = $set->poin31;
        }elseif ($early > 60 && $early <= 90)  {
            $cepat = $set->poin61;
        }elseif ($early > 90 )  {
            $cepat = $set->poin91;
        } else {
            $cepat = 0;
        }

        if ($row[8] == 'DNS') {
            $poin = 0;
            $ket = 2;
        } else {
            $poin = $lambat + $cepat;
        }


        //keterangan
        if ($late != 0 && $late < 180 && $early == 0) {
            $ket = 6 ; //Terlambat
        }elseif ($late == 0 && $early != 0 && $early < 180) {
            $ket = 7; //Pulang Cepat
        }elseif ($late != 0 && $late < 180 && $early != 0 && $early < 180) {
            $ket = 8; //Terlambat & Pulang Cepat
        }elseif ($late != "00:00" && $late >= 180 && $early == 0) {
            $ket = 9; //Tidak Absen Masuk
        }elseif ($late == 0 && $early != 0 && $early >= 180) {
            $ket = 10; //Tidak Absen Pulang
        }elseif ($late != 0 && $late < 180 && $early != 0 && $early >= 180) {
            $ket = 10; //Terlambat & Tidak Absen Pulang
        }elseif ($late != 0 && $late  >= 180 && $early != 0 && $early < 180) {
            $ket = 10; //Pulang Cepat & Tidak Absen Masuk
        } else {
            $ket = 1;
        }
        
       
        $user = User::where('no_pegawai',$row[0])->first();
        $hadir = Absensi::where('users_id',$user->id)->where('tanggal',$tanggal);
        $hadir->delete();

        if ($user) {
            return new Absensi([
                'periode_year'  => $tahun,
                'periode_month' => $bulan,
                'users_id'      => $user->id,
                'tanggal'       => $tanggal,
                'jam_masuk'     => $row[4],
                'jam_pulang'    => $row[5],
                'scan_masuk'    => $checkin,
                'scan_pulang'   => $checkout,
                'terlambat'     => $terlambat,
                'pulang_cepat'  => $pulang_cepat,
                'tipe'          => $row[8],
                'ket_absen_id'  => $ket,
                'poin'          => $poin
            ]);
        }
       
    }
}
