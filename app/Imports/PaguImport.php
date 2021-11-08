<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\PaguDetail;
use App\Activitycode;
use App\Subcode;
use App\Accountcode;

class PaguImport implements ToModel,WithStartRow
{
    private $pagu_id;

    public function  __construct($paguId)
    {
        $this->pagu_id = $paguId;
    }

    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        $act = $row[4]."/".$row[5]."/".$row[8]."/".$row[9];
        $activity = Activitycode::where('lengkap',$act)->first();

        $sub = $row[12]."/".$row[13]."/".$row[14]."/".$row[15];
        $subcode = Subcode::where('kodeall',$sub)->first();

        $akun = Accountcode::where('code',$row[21])->first();

        if ($subcode) {
            return new PaguDetail([
                'pagu_id'           => $this->pagu_id,
                'activitycode_id'   => $activity->id,
                'subcode_id'        => $subcode->id,
                'accountcode_id'    => $akun->id,
                'paguakhir'         => $row[22],
                'detail'            => $row[34],
                'realisasi'         => $row[28],
                'sisa'              => $row[29]

            ]);
        }
       
    }
}
