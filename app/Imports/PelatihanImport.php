<?php

namespace App\Imports;

use App\Pelatihan;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;

class PelatihanImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */    
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        $nip = str_replace(' ', '', $row[2]);
        $user = User::where('no_pegawai',$nip)->first();
        $namapel = $row[7];
        $desk = "Nomor Sertifikat : ".$row[14]."( Tgl :".$row[15].")";
        $rekam = "Y";
        $dari = str_replace('/', '-', $row[12]);
        $tgldari = date('Y-m-d', strtotime($dari));
        $sampai = str_replace('/', '-', $row[13]);
        $tglsampai = date('Y-m-d', strtotime($sampai));

        $jenis = $row[5];
        if ($jenis == 6 ||$jenis == 7 || $jenis == 8 || $jenis == 9) {
            $eva = "T";
        } else {
             $eva = "N";
        }

        // dd($user);
        
        $cek = Pelatihan::where('users_id', $user->id)
                        ->where('nama', $namapel)
                        ->where('dari',$tgldari)
                        ->first();

        if ($user) {
            if ($cek == null) {
                return new Pelatihan([
                    'users_id'          => $user->id,
                    'jenis_pelatihan_id'=> $jenis,
                    'nama'              => $row[7],
                    'dari'              => $tgldari,
                    'sampai'            => $tglsampai,
                    'lama'              => $row[16],
                    'penyelenggara'     => $row[9],
                    'terekam'           => $rekam,
                    'deskripsi'         => $desk,
                    'evaluasi'          => $eva
                ]);
            }
            
        }
    }
}
