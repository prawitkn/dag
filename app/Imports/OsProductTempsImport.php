<?php

namespace App\Imports;

use App\OsProductTemp;
use Maatwebsite\Excel\Concerns\ToModel;

class OsProductTempsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new OsProductTemp([
            'product_category_id'     => $row[0],
            'product_code'    => $row[1],
            'product_name'    => $row[2],
            'product_uom'    => $row[3],
            'price'    => $row[4],
        ]);
    }
}
