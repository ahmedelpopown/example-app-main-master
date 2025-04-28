<?php

namespace Database\Seeders;

use App\Models\Authority;
use App\Models\Regiment;
use App\Models\Soldier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
  $regiments = ['أول سرية','ثاني سرية','ثالث سرية'];
        foreach ($regiments as $name) {
            Regiment::create(['name' => $name]);
        }
    }
}
