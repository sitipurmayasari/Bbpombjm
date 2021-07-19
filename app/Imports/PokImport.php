<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Pok_detail;
use App\Krocode;
use App\Detailcode;
use App\Komponencode;
use App\Subcode;
use App\Accountcode;
use App\Loka;

class PokImport implements ToModel,WithStartRow
{
    private $pok_id;

    public function  __construct($pokId)
    {
        $this->pok_id= $pokId;
    }

    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        $kro = Krocode::where('code',$row[0])->first();
        $ro = Detailcode::where('name',$row[2])->first();
        $komponen = Komponencode::where('name',$row[4])->first();
        $sub = Subcode::where('name',$row[6])->first();
        $akun = Accountcode::where('code',$row[7])->first();
        $loka = Loka::where('nama',$row[8])->first();

        if ($kro) {
            return new Pok_detail([
                'pok_id' => $this->pok_id,
                'krocode_id' => $kro->id,
                'detailcode_id' => $ro->id,
                'komponencode_id' => $komponen->id,
                'subcode_id' => $sub->id,
                'accountcode_id' => $akun->id,
                'loka_id' => $loka->id,
                'volume' => $row[9],
                'price' => $row[10],
                'total' => $row[11],
                'sd'=> $row[12]
            ]);
        }
       
    }
}
