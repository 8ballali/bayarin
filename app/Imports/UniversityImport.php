<?php

namespace App\Imports;

use App\Models\Universities;
use Maatwebsite\Excel\Concerns\ToModel;

class UniversityImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Universities([
            'name' => $row[1],
        ]);
    }
}
