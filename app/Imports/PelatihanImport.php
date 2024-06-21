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
        // $user = User::where('no_pegawai',$row[2])->first();
        $desk = "Nomor Sertifikat : ".$row[14]."( Tgl :".$row[15].")";
        $rekam = "Y";
        $dari = str_replace('/', '-', $row[12]);
        $tgldari = date('Y-m-d', strtotime($dari));
        $sampai = str_replace('/', '-', $row[13]);
        $tglsampai = date('Y-m-d', strtotime($sampai));

        if ($user) {
            return new Pelatihan([
                'users_id'          => $user->id,
                'jenis_pelatihan_id'=> $row[5],
                'nama'              => $row[7],
                'dari'              => $tgldari,
                'sampai'            => $tglsampai,
                'lama'              => $row[16],
                'penyelenggara'     => $row[9],
                'terekam'           => $rekam,
                'deskripsi'         => $desk,
                'evaluasi'          => $row[20]
            ]);
        }
    }
}
