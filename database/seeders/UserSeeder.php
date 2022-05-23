<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id_number' => '1230020202020',
                'name' => 'Admin',
                'email' => 'admin@artilearning.com',
                'password' => bcrypt('password'),
                'gender' => 'Male',
                'birthplace' => 'Balikpapan',
                'date_of_birth' => '2002-05-14',
                'address' => 'KM 15, Balikpapan',
                'religion' => 'Islam',
                'major_id' => 1,
                'role' => 'admin',
            ],
            [
                'id_number' => '10201063',
                'name' => 'Muhammad Priandani Nur Ikhsan',
                'email' => '10201063@student.itk.ac.id',
                'password' => bcrypt('password'),
                'gender' => 'Male',
                'birthplace' => 'Bontang',
                'date_of_birth' => '2002-05-02',
                'address' => 'KM 15, Balikpapan',
                'religion' => 'Islam',
                'major_id' => 1,
                'role' => 'student',
            ],
            [
                'id_number' => '10201066',
                'name' => 'Muhammad Taufik',
                'email' => '10201066@student.itk.ac.id',
                'password' => bcrypt('password'),
                'gender' => 'Male',
                'birthplace' => 'Balikpapan',
                'date_of_birth' => '2002-05-01',
                'address' => 'KM 15, Balikpapan',
                'religion' => 'Islam',
                'major_id' => 1,
                'role' => 'student',
            ],
        ];

        for ($i=0; $i < count($users); $i++) { 
            User::create([
                'id_number' => $users[$i]['id_number'],
                'name' => $users[$i]['name'],
                'email' => $users[$i]['email'],
                'password' => $users[$i]['password'],
                'gender' => $users[$i]['gender'],
                'birthplace' => $users[$i]['birthplace'],
                'date_of_birth' => $users[$i]['date_of_birth'],
                'address' => $users[$i]['address'],
                'religion' => $users[$i]['religion'],
                'major_id' => $users[$i]['major_id'],
                'role' => $users[$i]['role']
            ]);
        }

    }
}
