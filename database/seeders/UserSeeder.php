<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123123'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'musyahya',
            'email' => 'musyahya@gmail.com',
            'password' => bcrypt('123123123'),
            'role_id' => 2
        ]);
    }
}
