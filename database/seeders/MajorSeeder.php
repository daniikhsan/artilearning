<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Major;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $majors = [
            [
                'name' => 'Fisika',
                'department_id' => 4
            ],
            [
                'name' => 'Matematika',
                'department_id' => 1
            ],
            [
                'name' => 'Teknik Mesin',
                'department_id' => 3
            ],
            [
                'name' => 'Teknik Elektro',
                'department_id' => 3
            ],
            [
                'name' => 'Teknik Kimia',
                'department_id' => 3
            ]
        ];

        for ($i=0; $i < count($majors); $i++) { 
            Major::create([
                'name' => $majors[$i]['name'],
                'department_id' => $majors[$i]['department_id'],
            ]);
        }
    }
}
