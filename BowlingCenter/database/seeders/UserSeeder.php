<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('admin123'), 'usertype' => '1',]);
        User::create(['name' => 'medewerker', 'email' => 'medewerker@gmail.com', 'password' => bcrypt('medewerker123'), 'usertype' => '2',]);
    }
}
