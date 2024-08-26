<?php

namespace App\Imports;

use App\Receipts;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class ServiceImport implements ToModel
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
            'id'=> $row[0],
            'guide'=> $row[1]
        ]);
    }
}
