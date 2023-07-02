<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {


        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2a$12$lfEF.vnnrKsvXGLnOPm1.OM3AMJdRh89KNfpJ2qjMwuujVdjUfcV2', // password

            ],
            [
                'name' => 'Manager',
                'email' => 'Manager@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2a$12$lfEF.vnnrKsvXGLnOPm1.OM3AMJdRh89KNfpJ2qjMwuujVdjUfcV2', // password

            ],
            [
                'name' => 'Amaal',
                'email' => 'Admin1@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2a$12$lfEF.vnnrKsvXGLnOPm1.OM3AMJdRh89KNfpJ2qjMwuujVdjUfcV2', // password

            ],
        ];


        foreach ($user as $key => $value) {

            User::create($value);
        }
    }
}
