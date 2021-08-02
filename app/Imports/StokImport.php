<?php

namespace App\Imports;

use App\Entrystock;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Inventaris;
class StokImport implements ToModel,WithStartRow
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
        $user = Inventaris::where('nama_barang',$row[0])->first();
        if ($user) {
            return new Entrystock([
                'inventaris_id' => $user->id,
                'entry_date' => $row[1],
                'stock' => $row[2],
                'exp_date' => $row[3]
            ]);
        }
       
    }
}
