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
        $checkin    = $row[6];
        $checkout   = $row[7];
        $late       = $row[9];
        $early      = $row[10]; 

        $date = str_replace('/', '-', $row[2]);
        $tanggal = date('Y-m-d', strtotime($date));
        $tahun = date("Y",strtotime($tanggal));
        $bulan = date("m",strtotime($tanggal));

        if ($late != "00:00" && $late <= "06:00" && $early == "00:00") {
            $ket = 6 ; //Terlambat
        }elseif ($late == "00:00" && $early != "00:00" && $early <= "06:00") {
            $ket = 7; //Pulang Cepat
        }elseif ($late != "00:00" && $late <= "06:00" && $early != "00:00" && $early <= "06:00") {
            $ket = 8; //Terlambat & Pulang Cepat
        }elseif ($late != "00:00" && $late >= "06:00" && $early == "00:00") {
            $ket = 9; //Tidak Absen Masuk
        }elseif ($late == "00:00" && $early != "00:00" && $early >= "06:00") {
            $ket = 10; //Tidak Absen Pulang
        }elseif ($late != "00:00" && $late <= "06:00" && $early != "00:00" && $early >= "06:00") {
            $ket = 10; //Terlambat & Tidak Absen Pulang
        }elseif ($late != "00:00" && $late <= "06:00" && $early != "00:00" && $early <= "06:00") {
            $ket = 10; //Pulang Cepat & Tidak Absen Masuk
        } else {
            $ket = 1;
        }
        

        $set = Setabsen::first();

        if ($late > "00:00" && $late <= "00:15") {
            $lambat = $set->poin1;
        }elseif ($late > "00:15" && $late <= "00:30")  {
            $lambat = $set->poin16;
        }elseif ($late > "00:30" && $late <= "00:60")  {
            $lambat = $set->poin31;
        }elseif ($late > "00:60" && $late <= "00:90")  {
            $lambat = $set->poin61;
        }elseif ($late > "00:90" )  {
            $lambat = $set->poin91;
        } else {
            $lambat = 0;
        }

        if ($early > "00:00" && $early <= "00:15") {
            $cepat = $set->poin1;
        }elseif ($early > "00:15" && $early <= "00:30")  {
            $cepat = $set->poin16;
        }elseif ($early > "00:30" && $early <= "00:90")  {
            $cepat = $set->poin31;
        }elseif ($early > "00:60" && $early <= "00:90")  {
            $cepat = $set->poin61;
        }elseif ($early > "00:90" )  {
            $cepat = $set->poin91;
        } else {
            $cepat = 0;
        }
        
       if ($row[8] == 'DNS') {
        $poin = 0;
       } else {
        $poin = $lambat + $cepat;
       }
       

        $user = User::where('no_pegawai',$row[0])->first();
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
                'terlambat'     => $late,
                'pulang_cepat'  => $early,
                'tipe'          => $row[8],
                'ket_absen_id'    => $ket,
                'poin'          => $poin
            ]);
        }
       
    }
}
