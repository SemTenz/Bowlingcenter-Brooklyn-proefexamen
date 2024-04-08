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
        User::create(['name' => 'Mazin', 'firstname' => 'Mazin', 'lastname' => 'jamil', 'email' => 'm.jamil@gmail.com', 'password' => bcrypt('mazinjamil'), 'usertype' => '3',]);
        User::factory()->count(10)->create();
    }
}
