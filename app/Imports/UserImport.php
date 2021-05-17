<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;

class UserImport implements ToModel,WithStartRow
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
        return new User([
            'id' => $row[17],
            'no_pegawai'    => $row[0],
            'name'          => $row[1],
            'email'         => $row[2],
            'password'      => bcrypt("12345678"),
            'remember_token'=> Str::random(60),
            'tempat_lhr'    => $row[4],
            'tgl_lhr'       => $row[5],
            'nikah'         => $row[7],
            'jkel'          => $row[8],
            'jabatan_id'    => $row[10],
            'jabasn_id'     => $row[11],
            'status'        => $row[12],
            'divisi_id'     => $row[13],
            'subdivisi_id'  => $row[14],
            'golongan_id'   => $row[15],
            'aktif'         => $row[16]

        ]);
    }
}
