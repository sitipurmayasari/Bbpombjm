<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Pok_detail;
use App\Activitycode;
use App\Programcode;
use App\Unitcode;
use App\Klcode;
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
        $act = Activitycode::where('lengkap',$row[0])
                            ->first();
        $sub = Subcode::where('kodeall',$row[1])
                        ->SelectRaw('subcode.id AS sub_id, krocode.id AS kro_id, detailcode.id AS det_id, komponencode.id AS kom_id')
                        ->LeftJoin('komponencode','komponencode.id','=','subcode.komponencode_id')
                        ->LeftJoin('detailcode','detailcode.id','=','komponencode.detailcode_id')
                        ->LeftJoin('krocode','krocode.id','=','detailcode.krocode_id')
                        ->first();
        $akun = Accountcode::where('code',$row[2])->first();
        $loka = Loka::where('nama',$row[3])->first();

        if ($sub) {
            return new Pok_detail([
                'pok_id'          => $this->pok_id,
                'activitycode_id' => $this->act->id,
                'krocode_id'      => $sub->kro_id,
                'detailcode_id'   => $sub->det_id,
                'komponencode_id' => $sub->kom_id,
                'subcode_id'      => $sub->sub_id,
                'accountcode_id'  => $akun->id,
                'loka_id'         => $loka->id,
                'volume'          => $row[4],
                'price'           => $row[5],
                'total'           => $row[6],
                'sd'              => $row[7],
                'realisasi'       => $row[8],
                'sisa'            => $row[9]
            ]);
        }
       
    }
}
