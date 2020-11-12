<?php

namespace App\Exports;

use App\OsProduct;
use Maatwebsite\Excel\Concerns\FromCollection;

class OsProductsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return OsProduct::all();
    }
}
