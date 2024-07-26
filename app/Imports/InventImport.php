<?php

namespace App\Imports;

use App\Inventaris;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;

class InventImport implements ToModel,WithStartRow
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
        return new Inventaris([
            'nama_barang'       => $row[0],
            'kode_barang'       => $row[1],
            'jenis_barang'      => $row[2],
            'satuan_id'         => $row[3],
            'merk'              => $row[4],
            'lokasi'            => $row[5],
            'penanggung_jawab'  => $row[6],
            'kind'              => $row[7]

        ]);
    }
}
