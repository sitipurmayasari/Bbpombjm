<?php

namespace App\Imports;

use App\TukinDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\User;
class TukinImport implements ToModel,WithStartRow
{
    private $tukin_id;

    public function  __construct($tukinId)
    {
        $this->tukin_id= $tukinId;
    }

    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        $user = User::where('no_pegawai',$row[0])->first();
        // dd($row[0]);
        if ($user) {
            return new TukinDetail([
                'tukin_id' => $this->tukin_id,
                'users_id' => $user->id,
                'nilai' => $row[2],
                'potongan' => $row[3],
                'terima' => $row[5],
                'potonganRp'=> $row[4]
            ]);
        }
       
    }
}
