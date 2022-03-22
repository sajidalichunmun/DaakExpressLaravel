<?php

namespace App\Imports;

use App\KCT_BlockContainers;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new KCT_BlockContainers([
            'name'     => $row[0],
            'email'    => $row[1], 
            'password' => \Hash::make('123456'),
        ]);
    }
}
