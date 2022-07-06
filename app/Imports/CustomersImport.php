<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithUpserts;

class CustomersImport implements ToModel,WithUpserts, WithBatchInserts,SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'code'     => $row[0],
            'name'    => $row[1],
            'town'    =>$row[2],
            'province'=>$row[3],
        ]);
    }
    public function uniqueBy()
    {
        return 'code';
    }
    public function batchSize(): int
    {
        return 200;
    }
    
   
}
