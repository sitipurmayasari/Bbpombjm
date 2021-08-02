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
            'harga'             => $row[2],
            'jenis_barang'      => $row[3],
            'jumlah_barang'     => $row[4],
            'satuan_id'         => $row[5],
            'merk'              => $row[6],
            'no_seri'           => $row[7],
            'lokasi'            => $row[8],
            'penanggung_jawab'  => $row[9],
            'kind'              => $row[10]

        ]);
    }
}
