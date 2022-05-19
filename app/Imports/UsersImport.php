<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'id_number' => $row['id_number'],
            'name' => $row['name'],
            'password' => bcrypt('password'),
            'email' => $row['email'],
            'gender' => $row['gender'],
            'birthplace' => $row['birthplace'],
            'date_of_birth' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth'])->format('Y-m-d'),
            'address' => $row['address'],
            'religion' => $row['religion'],
            'role' => $row['role'],
            'major_id' => $row['major_id'],
        ]);
    }
}
