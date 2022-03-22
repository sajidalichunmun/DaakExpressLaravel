<?php

namespace App\Exports;

use App\KCT_BlockContainers;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return KCT_BlockContainers::all();
    }
}
