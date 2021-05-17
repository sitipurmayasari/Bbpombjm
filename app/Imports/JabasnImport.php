<?php

namespace App\Imports;

use App\Jabasn;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
class JabasnImport implements ToModel,WithStartRow
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
        return new Jabasn([
            'id' => $row[0],
            'nama'=> $row[1]
        ]);
    }
}
