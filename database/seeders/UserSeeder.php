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
                'name' => 'Muhammad Priandani Nur Ikhsan',
                'email' => '10201063@student.itk.ac.id',
                'password' => bcrypt('password'),
                'gender' => 'Laki-Laki',
                'birthplace' => 'Bontang',
                'date_of_birth' => '2002-05-02',
                'address' => 'KM 15, Balikpapan',
                'religion' => 'Islam',
                'major_id' => 1
            ]
        ];

        for ($i=0; $i < count($users); $i++) { 
            User::create([
                'name' => $users[$i]['name'],
                'email' => $users[$i]['email'],
                'password' => $users[$i]['password'],
                'gender' => $users[$i]['gender'],
                'birthplace' => $users[$i]['birthplace'],
                'date_of_birth' => $users[$i]['date_of_birth'],
                'address' => $users[$i]['address'],
                'religion' => $users[$i]['religion'],
                'major_id' => $users[$i]['major_id']
            ]);
        }

    }
}
