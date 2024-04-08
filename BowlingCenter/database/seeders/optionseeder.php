<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Options;

class optionseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Options::create(['option' => 'snackpakketbasis']);
        Options::create(['option' => 'snackpakketluxe']);
        Options::create(['option' => 'kinderpartij']);
        Options::create(['option' => 'vrijgezellenfeest']);
    }
}
