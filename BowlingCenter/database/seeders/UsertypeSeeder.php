<?php

namespace Database\Seeders;

use App\Models\usertype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        usertype::create(['usertype' => 'admin']);
        usertype::create(['usertype' => 'medewerker']);
        usertype::create(['usertype' => 'klant']);
    }
}
