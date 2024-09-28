<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TendikImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new User([
            'nip'                => $row['nip'],
            'nama_lengkap'       => $row['nama_lengkap'],
            'email'              => $row['email'],
            'role'               => $row['role'],
            'password'           => Hash::make($row['password']),
        ]);
    }
}
