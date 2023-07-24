<?php

namespace App\Imports;

use App\Receipts;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class ReceiptsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;

    public function model(array $row)
    {
        return new Receipts([
            'policy'=> $row[0],
            'status'=> $row[1],
            'initial_date'=> $row[2],
            'amount'=> $row[3]
        ]);
    }
}
