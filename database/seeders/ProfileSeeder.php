<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profiles')->insert([
            [
                'fullname' => 'Admin',
                'nik' => '0034567891234500',
                'email' => 'admin@gmail.com',
                'phone' => '082210102020',
                'address' => 'Baru',
                'birthdate' => Carbon::create('1980', '12', '30')->format('Y-m-d'),
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'fullname' => 'Andika Saputra',
                'nik' => '1234567891234510',
                'email' => 'andika@gmail.com',
                'phone' => '082210102020',
                'address' => 'Kabinuang',
                'birthdate' => Carbon::create('1997', '12', '29')->format('Y-m-d'),
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'fullname' => 'Firo',
                'nik' => '1234567891234520',
                'email' => 'firo@gmail.com',
                'phone' => '082210102030',
                'address' => 'Jl Gajah Mada',
                'birthdate' => Carbon::create('1999', '05', '13')->format('Y-m-d'),
                'user_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'fullname' => 'Putri',
                'nik' => '1234567891234530',
                'email' => 'putri@gmail.com',
                'phone' => '082210102040',
                'address' => 'Panasakan',
                'birthdate' => Carbon::create('2000', '11', '25')->format('Y-m-d'),
                'user_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
