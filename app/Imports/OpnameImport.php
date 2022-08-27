<?php

namespace App\Imports;

use App\Opnamedetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Inventaris;
class TukinImport implements ToModel,WithStartRow
{
    private $opname_id;

    public function  __construct($opnameId)
    {
        $this->opname_id= $opnameId;
    }

    public function startRow(): int
    {
        return 6;
    }
    public function model(array $row)
    {
        $barang = Inventaris::where('id',$row[0])->first();
        // dd($row[0]); 
        if ($barang) {
            return new Opnamedetail([
                'opname_id' => $this->opname_id,
                'inventaris_id' => $row[0],
                'stok_kartu' => $row[5],
                'stok_fisik' => $row[6],
                'selisih' => $row[7],
                'keterangan'=> $row[8]
            ]);
        }
       
    }
}
