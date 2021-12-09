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

        $act = $row[4]."/".$row[5]."/".$row[8]."/".$row[9];
        $activity = Activitycode::where('lengkap',$act)->first();

        $subcode = $row[12]."/".$row[13]."/".$row[14]."/".$row[15];
        $sub = Subcode::where('kodeall',$subcode)
                        ->SelectRaw('subcode.id AS sub_id, krocode.id AS kro_id, detailcode.id AS det_id, komponencode.id AS kom_id')
                        ->LeftJoin('komponencode','komponencode.id','=','subcode.komponencode_id')
                        ->LeftJoin('detailcode','detailcode.id','=','komponencode.detailcode_id')
                        ->LeftJoin('krocode','krocode.id','=','detailcode.krocode_id')
                        ->first();
        
        $akun   = Accountcode::where('code',$row[21])->first();
        $loka   = "1";
        $sd     = "RM";
        $vol    = "1";

        if ($sub) {
            return new Pok_detail([
                'pok_id'          => $this->pok_id,
                'activitycode_id' => $activity->id,
                'krocode_id'      => $sub->kro_id,
                'detailcode_id'   => $sub->det_id,
                'komponencode_id' => $sub->kom_id,
                'subcode_id'      => $sub->sub_id,
                'accountcode_id'  => $akun->id,
                'loka_id'         => $loka,
                'volume'          => $vol,
                'price'           => $row[22],
                'total'           => $row[22],
                'sd'              => $sd,
                'realisasi'       => $row[28],
                'sisa'            => $row[29],
                'detail'          => $row[34]

            ]);
        }
       
    }
}