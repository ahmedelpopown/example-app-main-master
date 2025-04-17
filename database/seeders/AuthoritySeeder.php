<?php

namespace Database\Seeders;

use App\Models\Authority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthoritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authorities = ['قوات امن الاسماعليه', 'مدوريه امن الاسماعليه'];

        foreach ($authorities as $name) {
            Authority::create(['name' => $name]);
        }
    }
}
