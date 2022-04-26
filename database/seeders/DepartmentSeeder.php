<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            'Jurusan Matematika dan Teknologi Informasi', 
            'Jurusan Sains, Teknologi Pangan, dan Kemaritiman', 
            'Jurusan Teknologi Industri dan Proses', 
            'Jurusan Teknik Sipil dan Perencanaan', 
            'Jurusan Ilmu Kebumian dan Lingkungan', 
        ];

        for ($i=0; $i < count($departments); $i++) { 
            Department::create([
                'name' => $departments[$i]
            ]);
        }
    }
}
